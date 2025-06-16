<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\InvoiceStatusHistory;
use App\Models\Product;
use App\Models\ReturnItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Log;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Invoice::with(['store', 'items']);

        // Staff users only see their own store
        if (!auth()->user()->isAdmin()) {
            $query->where('store_id', auth()->user()->store_id);
        }

        // Filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('store_id') && auth()->user()->isAdmin()) {
            $query->where('store_id', $request->store_id);
        }

        if ($request->filled('search')) {
            $query->where('customer_name', 'like', '%' . $request->search . '%');
        }

        $invoices = $query->latest()->paginate(10)->withQueryString();
        $stores = \App\Models\Store::all();

        return view('invoices.index', compact('invoices', 'stores'));
    }

    // Show form to create invoice
    public function create()
    {
        $store = auth()->user()->store;

        if (!$store) {
            return back()->with('error', 'You are not assigned to a store.');
        }

        $products = Product::where('store_id', $store->id)->get();

        return view('invoices.create', compact('products'));
    }

    // Store the invoice and items
    public function store(Request $request)
    {
        $request->validate([
            'customer_name'     => 'required|string|max:255',
            'customer_address'  => 'nullable|string|max:255',
            'notes'             => 'nullable|string',
            'status'            => 'required|in:paid,not-paid',
            'product_id'        => 'required|array',
            'product_id.*'      => 'exists:products,id',
            'quantity'          => 'required|array',
            'quantity.*'        => 'required|integer|min:1',
            'price'             => 'required|array',
            'price.*'           => 'required|numeric|min:0',
            'description' => 'required|array',
            'description.*' => 'required|string',
        ]);

        $store = auth()->user()->store;

        if (!$store) {
            return back()->with('error', 'No store assigned.');
        }

        // Calculate total
        $total = array_sum(array_map(fn($qty, $price) => $qty * $price, $request->quantity, $request->price));

        try {
            DB::beginTransaction();

            // Create invoice
            $invoice = Invoice::create([
                'invoice_number'    => 'INV-' . strtoupper(Str::random(8)),
                'customer_name'     => $request->customer_name,
                'customer_address'  => $request->customer_address,
                'notes'             => $request->notes,
                'status'            => $request->status,
                'user_id'           => auth()->id(),
                'store_id'          => $store->id,
                'total_amount'      => $total,
            ]);

            foreach ($request->product_id as $index => $productId) {
                $product = Product::where('id', $productId)->where('store_id', $store->id)->lockForUpdate()->first();

                if (!$product) {
                    DB::rollBack();
                    return back()->with('error', "Product not found or not in your store.");
                }

                $qty = $request->quantity[$index];

                if ($product->quantity < $qty) {
                    DB::rollBack();
                    return back()->with('error', "{$product->name} does not have enough stock.");
                }

                // Decrement stock
                $product->decrement('quantity', $qty);

                // Create invoice item
                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'product_id' => $productId,
                    'quantity'   => $qty,
                    'price'      => $request->price[$index],
                    'description' => $request->description[$index]
                ]);
            }

            DB::commit();

            return redirect()->route('invoices.index')->with('success', 'Invoice created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            // Log the error for debugging
            \Log::error('Invoice creation failed: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
    // Show single invoice
    public function show($id)
    {
        $invoice = Invoice::with(['items.product', 'store'])->findOrFail($id);

        if (!auth()->user()->isAdmin() && $invoice->store_id != auth()->user()->store_id) {
            abort(403);
        }

        return view('invoices.show', compact('invoice'));
    }


    // Update invoice status (paid / not-paid)
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:paid,not-paid',
        ]);

        $invoice = Invoice::findOrFail($id);

        if (!auth()->user()->isAdmin() && $invoice->store_id != auth()->user()->store_id) {
            abort(403);
        }

        $invoice->update([
            'status' => $request->status
        ]);

        return redirect()->route('invoices.show', $invoice->id)->with('success', 'Invoice status updated.');
    }


    public function returnItem(Request $request)
    {
        $validated = $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'item_id' => 'required|exists:invoice_items,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'reason' => 'required|string'
        ]);

        try {
            DB::beginTransaction();

            $invoice = Invoice::lockForUpdate()->findOrFail($validated['invoice_id']);
            $item = InvoiceItem::lockForUpdate()->findOrFail($validated['item_id']);
            $product = Product::lockForUpdate()->findOrFail($validated['product_id']);

            if ($validated['quantity'] > $item->quantity) {
                throw new \Exception('Return quantity cannot exceed original purchase quantity');
            }

            // Update product inventory
            $product->increment('quantity', $validated['quantity']);

            // Create return record
            ReturnItem::create([
                'invoice_id' => $invoice->id,
                'product_id' => $product->id,
                'invoice_item_id' => $item->id, // Add this line
                'quantity_returned' => $validated['quantity'],
                'unit_price' => $item->price,
                'total_amount' => $validated['quantity'] * $item->price,
                'reason' => $validated['reason'],
                'returned_by' => auth()->id(),
                'returned_at' => now()
            ]);

            // Rest of your return logic...
            $amountToDeduct = $validated['quantity'] * $item->price;

            if ($validated['quantity'] == $item->quantity) {
                $item->delete();
            } else {
                $item->decrement('quantity', $validated['quantity']);
            }

            $invoice->decrement('total_amount', $amountToDeduct);

            if ($invoice->items()->count() === 0) {
                $invoice->update(['status' => 'void']);
                InvoiceStatusHistory::create([
                    'invoice_id' => $invoice->id,
                    'status' => 'void',
                    'changed_by' => auth()->id()
                ]);
            }

            DB::commit();
            return back()->with('success', 'Product returned successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to return product: ' . $e->getMessage());
        }
    }
    public function print(Invoice $invoice)
    {
        // Load necessary relationships
        $invoice->load('items.product');

        // For PDF generation
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('invoices.print', [
            'invoice' => $invoice,
            'company' => [
                'name' => config('app.name'),
                'address' => '123 Business Street, Lagos, Nigeria',
                'phone' => '+234 800 000 0000',
                'email' => 'info@example.com',
                'logo' => public_path('images/logo.png') // Path to your logo
            ]
        ]);

        // Set paper options
        $pdf->setPaper('A4', 'portrait');

        // Download or stream
        return $pdf->stream("invoice-{$invoice->invoice_number}.pdf");

        // Alternatively to download:
        // return $pdf->download("invoice-{$invoice->invoice_number}.pdf");
    }
}
