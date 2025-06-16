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
    $staff = auth()->user(); // Assume this is a staff user
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

    $assignedProducts = Product::orderBy('name')->where('store_id', $staff->store_id)->get();

    foreach ($assignedProducts as $product) {
        $sold = InvoiceItem::where('product_id', $product->id)
            ->whereHas('invoice', function ($q) use ($startDate, $endDate, $staff) {
                $q->whereBetween('created_at', [$startDate, $endDate]);
                $q->whereHas('items.product', fn ($q) => $q->where('store_id', $staff->store_id));
            })
            ->sum('quantity');

        $product->total_sold = $sold;
        $product->total_value = InvoiceItem::where('product_id', $product->id)
            ->whereHas('invoice', function ($q) use ($startDate, $endDate, $staff) {
                $q->whereBetween('created_at', [$startDate, $endDate]);
            })->sum(DB::raw('quantity * price'));
    }


    $summary = [
        'total_assigned' => $assignedProducts->count(),
        'total_sold' => $assignedProducts->sum('total_sold'),
        'remaining_stock' => $assignedProducts->sum(fn ($p) => $p->quantity),
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
