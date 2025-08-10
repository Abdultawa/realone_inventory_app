<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\SoldProduct;
use Illuminate\Support\Facades\Auth;
use App\Models\Invoice;



class StaffDashboardController extends Controller
{

    public function index(Request $request)
    {
        $staff = auth()->user();
        $startDate = $request->start_date ?? Carbon::now()->startOfMonth()->toDateString();
        $endDate = $request->end_date ?? Carbon::now()->endOfMonth()->toDateString();

        // Filter invoices based on the staff's store
        $invoices = Invoice::whereHas('items.product', function ($query) use ($staff) {
            $query->where('store_id', $staff->store_id);
        })
        ->whereBetween('created_at', [$startDate, $endDate])
        ->with('items.product')
        ->get();

        // Summary stats
        $totalPaid = $invoices->where('status', 'paid')->sum('total_amount');
        $totalUnpaid = $invoices->where('status', 'not-paid')->sum('total_amount');

        // Unpaginated data for card summaries
        $allProducts = Product::where('store_id', $staff->store_id)->orderBy('name')->get();
        foreach ($allProducts as $product) {
            $sold = InvoiceItem::where('product_id', $product->id)
                ->whereHas('invoice', function ($q) use ($startDate, $endDate, $staff) {
                    $q->whereBetween('created_at', [$startDate, $endDate])
                      ->whereHas('items.product', fn ($q) => $q->where('store_id', $staff->store_id));
                })
                ->sum('quantity');

            $product->total_sold = $sold;
            $product->total_value = InvoiceItem::where('product_id', $product->id)
                ->whereHas('invoice', function ($q) use ($startDate, $endDate, $staff) {
                    $q->whereBetween('created_at', [$startDate, $endDate]);
                })->sum(DB::raw('quantity * price'));
        }

        // Paginated data for table
        $assignedProducts = Product::where('store_id', $staff->store_id)->orderBy('name')->paginate(10);
        foreach ($assignedProducts as $product) {
            $sold = InvoiceItem::where('product_id', $product->id)
                ->whereHas('invoice', function ($q) use ($startDate, $endDate, $staff) {
                    $q->whereBetween('created_at', [$startDate, $endDate])
                      ->whereHas('items.product', fn ($q) => $q->where('store_id', $staff->store_id));
                })
                ->sum('quantity');

            $product->total_sold = $sold;
            $product->total_value = InvoiceItem::where('product_id', $product->id)
                ->whereHas('invoice', function ($q) use ($startDate, $endDate, $staff) {
                    $q->whereBetween('created_at', [$startDate, $endDate]);
                })->sum(DB::raw('quantity * price'));
        }

        $summary = [
            'total_assigned' => $allProducts->count(),
            'total_sold' => $allProducts->sum('total_sold'),
            'remaining_stock' => $allProducts->sum(fn ($p) => $p->quantity),
            'total_paid' => $totalPaid,
            'total_unpaid' => $totalUnpaid,
        ];

        return view('staff.dashboard', compact(
            'staff',
            'assignedProducts',
            'summary',
            'startDate',
            'endDate'
        ));
    }

}
