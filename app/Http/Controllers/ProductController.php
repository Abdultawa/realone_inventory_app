<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::orderBy('name')->with(['store', 'category']);

        if (!auth()->user()->isAdmin()) {
            $store = auth()->user()->store;

            if (!$store) {
                return back()->with('error', 'No store assigned to your account.');
            }

            // Staff: always restrict to their store
            $query->where('store_id', $store->id);
        } else {
            // Admin: allow filter by store
            if ($request->filled('store')) {
                $query->where('store_id', $request->store);
            }
        }

        // Filters for everyone
        if ($request->filled('status')) {
            $query->byStockStatus($request->status);
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->paginate(15)->withQueryString();
        $stores = Store::all();
        $categories = Category::all();

        return view('products.index', compact('products', 'stores', 'categories'));
    }
    public function create()
    {
        $stores = Store::all();
        $categorys = Category::all();
        return view('products.create', compact('stores', 'categorys'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'store_id' => 'required|exists:stores,id',
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'product_code' => 'string',
        ]);
        $exists = Product::where('user_id', auth()->id())
                ->where('store_id', $request->store_id)
                ->where('name', $request->name)
                ->where('product_code', $request->product_code)
                ->exists();

            if ($exists) {
                return back()->withErrors(['name' => 'You have already added this product to the selected store.'])->withInput();
            }
        Product::create([
            'user_id' => auth()->id(),
            'store_id' => $request->store_id,
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'product_code' => $request->product_code
        ]);

        return redirect()->route('products.index')->with('status', 'Product created successfully.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $stores = Store::all();
        $categorys = Category::all();
        return view('products.edit', compact('product', 'stores', 'categorys'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'store_id' => 'required|exists:stores,id',
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'product_code' => 'string',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->only('store_id', 'name', 'description', 'price', 'quantity', 'category_id','product_code'));

        return redirect()->route('products.index')->with('status', 'Product updated successfully.');
    }

    public function storeQuantity(Request $request, Product $product)
    {
        $request->validate([
            'added_quantity' => 'required|integer|min:1',
        ]);

        // Save the existing quantity before updating
        $existingQuantity = $product->quantity;
        $addedQuantity = $request->added_quantity;

        // Update the product's quantity
        $product->update([
            'quantity' => $existingQuantity + $addedQuantity,
        ]);


        return redirect()->route('products.index')->with('success', 'Quantity added successfully!');
    }
    public function destroy($id)
    {
        Product::destroy($id);
        return redirect()->route('products.index')->with('status', 'Product deleted.');
    }

    public function getDetails(Product $product)
    {
        return response()->json([
            'quantity' => $product->quantity,
            'store_id' => $product->store_id
        ]);
    }
}
