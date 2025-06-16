<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Product;
use App\Models\SoldProduct;
use Illuminate\Support\Carbon;

class UserController extends Controller
{


    public function dashboard()
    {
        // Get the current store ID if applicable
        $currentStoreId = auth()->user()->store_id ?? null;

        // Base query for products
        $productQuery = Product::query()
            ->when($currentStoreId, fn($q) => $q->where('store_id', $currentStoreId))
            ->with('category')->
            orderBy('name');

        // Total products count and change
        $totalProducts = $productQuery->count();
        $previousMonthProducts = $productQuery->clone()
            ->where('created_at', '<', now()->subMonth())
            ->count();
        $productsChange = $previousMonthProducts > 0 ?
            round(($totalProducts - $previousMonthProducts) / $previousMonthProducts * 100, 1) : 0;

        // Category distribution
        $categoryCounts = Category::query()
            ->withCount(['products' => function($query) use ($currentStoreId) {
                if ($currentStoreId) {
                    $query->where('store_id', $currentStoreId);
                }
            }])
            ->orderBy('name')
            ->get()
            ->pluck('products_count', 'name')
            ->toArray();

        // Low stock items
        $lowStockThreshold = config('inventory.low_stock_threshold', 10);
        $lowStockProducts = $productQuery->clone()
            ->where('quantity', '<=', $lowStockThreshold)
            ->count();
        $previousMonthLowStock = $productQuery->clone()
            ->where('created_at', '<', now()->subMonth())
            ->where('quantity', '<=', $lowStockThreshold)
            ->count();
        $lowStockChange = $previousMonthLowStock > 0 ?
            round(($lowStockProducts - $previousMonthLowStock) / $previousMonthLowStock * 100, 1) : 0;
        $lowStockPercentage = $totalProducts > 0 ? round($lowStockProducts / $totalProducts * 100) : 0;

        // Inventory value calculations
        $totalValue = $productQuery->clone()->sum(DB::raw('price * quantity'));
        $previousMonthValue = $productQuery->clone()
            ->where('created_at', '<', now()->subMonth())
            ->sum(DB::raw('price * quantity'));
        $valueChange = $previousMonthValue > 0 ?
            round(($totalValue - $previousMonthValue) / $previousMonthValue * 100, 1) : 0;

        // Recent activity
        $recentlyAdded = $productQuery->clone()
            ->where('created_at', '>', now()->subDays(7))
            ->count();
        $recentProducts = $productQuery->clone()
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get(['id', 'product_code', 'name', 'created_at']);

        // Monthly value data for charts
        $monthlyValueData = [];
        for ($i = 0; $i < 12; $i++) {
            $monthlyValueData[] = $productQuery->clone()
                ->whereMonth('created_at', now()->subMonths(11 - $i)->month)
                ->sum(DB::raw('price * quantity'));
        }

        // Daily trend data for the last 30 days
        $trendData = [];
        $trendDates = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $trendDates[] = $date->format('M d');
            $trendData[] = $productQuery->clone()
                ->whereDate('created_at', '<=', $date)
                ->sum(DB::raw('price * quantity'));
        }

        $monthlyValue = $productQuery->clone()
            ->whereMonth('created_at', now()->month)
            ->sum(DB::raw('price * quantity'));
        $valueTrendDescription = $valueChange >= 0 ?
            'Inventory value increased by ' . abs($valueChange) . '% from last month' :
            'Inventory value decreased by ' . abs($valueChange) . '% from last month';

        // Products for the table
        $inventoryProducts = $productQuery->clone()
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get(['id', 'product_code', 'name', 'price', 'quantity', 'created_at', 'category_id']);

        // All categories for filter
        $categories = Category::orderBy('name')->get(['id', 'name']);

        return view('dashboard', compact(
            'totalProducts',
            'productsChange',
            'categoryCounts',
            'lowStockProducts',
            'lowStockChange',
            'lowStockPercentage',
            'totalValue',
            'valueChange',
            'recentlyAdded',
            'recentProducts',
            'monthlyValueData',
            'trendData',
            'trendDates',
            'monthlyValue',
            'valueTrendDescription',
            'inventoryProducts',
            'categories',
            'lowStockThreshold'
        ));
    }



    // List all users
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Show the form for creating a new user
    public function create()
    {
        $stores = Store::all();
        return view('users.create', compact('stores'));
    }

    // Store a new user
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string',
            'store_id' => 'nullable|exists:stores,id',
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'store_id' => $request->store_id,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }

    public function edit(User $user)
    {
        $stores = Store::all();
        return view('users.edit', compact('user', 'stores'));
    }

    // Update a user
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'role' => 'required|string',
            'store_id' => 'nullable|exists:stores,id',
        ]);

        // Update the user
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'role' => $request->role,
            'store_id' => $request->store_id,
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }
    // Deactivate a user
    public function deactivate(User $user)
    {
        $user->update(['status' => 'inactive']);

        return redirect()->route('users.index')->with('success', 'User deactivated successfully!');
    }

    // Activate a user
    public function activate(User $user)
    {
        $user->update(['status' => 'active']);

        return redirect()->route('users.index')->with('success', 'User activated successfully!');
    }

    // Delete a user
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }
}
