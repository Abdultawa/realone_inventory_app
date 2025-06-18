<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use App\Models\ProductTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductTransferController extends Controller
{
    public function index()
    {
        $transfers = ProductTransfer::with(['product', 'fromStore', 'toStore', 'transferredBy'])
            ->latest()
            ->paginate(20);

        return view('transfers.index', compact('transfers'));
    }

    public function create()
    {
        $products = Product::with('store')->where('quantity', '>', 0)->get();
        $stores = Store::all();
        return view('transfers.create', compact('products', 'stores'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'from_store_id' => 'required|exists:stores,id',
            'to_store_id' => 'required|exists:stores,id|different:from_store_id',
            'quantity' => 'required|integer|min:1',
            'reason' => 'nullable|string|max:500'
        ]);

        try {
            DB::beginTransaction();

            $product = Product::findOrFail($validated['product_id']);

            // Validate the product belongs to the from_store
            if ($product->store_id != $validated['from_store_id']) {
                throw new \Exception('Product does not belong to the selected source store');
            }

            // Validate the product has enough quantity
            if ($product->quantity < $validated['quantity']) {
                throw new \Exception('Not enough stock. Available: ' . $product->quantity);
            }

            // Check if product already exists in destination store
            $destinationProduct = Product::where('product_code', $product->product_code)
                ->where('store_id', $validated['to_store_id'])
                ->first();

            // Create transfer record
            $transfer = ProductTransfer::create([
                'product_id' => $product->id,
                'from_store_id' => $validated['from_store_id'],
                'to_store_id' => $validated['to_store_id'],
                'quantity' => $validated['quantity'],
                'reason' => $validated['reason'],
                'transferred_by' => auth()->id(),
                'transferred_at' => now()
            ]);

            // Update source product quantity
            $product->decrement('quantity', $validated['quantity']);

            if ($destinationProduct) {
                // Update existing product in destination store
                $destinationProduct->increment('quantity', $validated['quantity']);
            } else {
                // Create new product in destination store
                Product::create([
                    'product_code' => $product->product_code,
                    'user_id' => $product->user_id,
                    'store_id' => $validated['to_store_id'],
                    'category_id' => $product->category_id,
                    'name' => $product->name,
                    'description' => $product->description,
                    'price' => $product->price,
                    'quantity' => $validated['quantity'],
                    // Copy other relevant fields as needed
                ]);
            }

            DB::commit();

            return redirect()->route('transfers.index')
                ->with('success', 'Product transferred successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Transfer failed: ' . $e->getMessage());
        }
    }

    public function show(ProductTransfer $transfer)
    {
        return view('transfers.show', compact('transfer'));
    }
}
