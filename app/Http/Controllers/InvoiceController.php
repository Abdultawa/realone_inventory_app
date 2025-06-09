<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        ]);

        $store = auth()->user()->store;

        if (!$store) {
            return back()->with('error', 'No store assigned.');
        }
        // $totalAmount = 0;

        $total = array_sum(array_map(fn($qty, $price) => $qty * $price, $request->quantity, $request->price));
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

        // Loop through each product and attach to invoice
        foreach ($request->product_id as $index => $productId) {
            $product = Product::where('id', $productId)->where('store_id', $store->id)->first();

            if (!$product) {
                return back()->with('error', "Product not found or not in your store.");
            }

            $qty = $request->quantity[$index];
            if ($product->quantity < $qty) {
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
            ]);
        }

        return redirect()->route('invoices.index')->with('success', 'Invoice created successfully.');
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
}
