<?php
namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::paginate(10);
        return view('stores.index', compact('stores'));
    }

    public function create()
    {
        return view('stores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:stores,name,NULL,id,user_id,' . auth()->id(),
            'description' => 'nullable|string',
        ]);

        Store::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('stores.index')->with('status', 'Store created successfully.');
    }
    public function edit(Store $store)
    {
        return view('stores.edit', compact('store'));
    }

    public function update(Request $request, Store $store)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:stores,name,' . $store->id . ',id,user_id,' . auth()->id(),
            'description' => 'nullable|string',
        ]);

        $store->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('stores.index')->with('status', 'Store updated successfully.');
    }

    public function destroy(Store $store)
    {
        $this->authorize('delete', $store); // optional
        $store->delete();

        return redirect()->route('stores.index')->with('status', 'Store deleted.');
    }

}
