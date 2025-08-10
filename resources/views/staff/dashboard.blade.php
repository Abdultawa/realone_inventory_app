<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-bold fs-2 text-gray-900">📦 Inventory Dashboard</h2>
        <span class="text-gray-500">Welcome back, {{ $staff->name }} — Track your stock, sales & performance.</span>
    </x-slot>

    <div class="container-xxl">

        <!-- Quick Actions -->
               <!-- KPI Cards -->
        <div class="row g-6 mb-6">
            @php
                $cards = [
                    ['title' => 'Total Products Assigned', 'value' => $summary['total_assigned'], 'icon' => 'ki-box', 'color' => 'primary'],
                    ['title' => 'Total Sold', 'value' => $summary['total_sold'], 'icon' => 'ki-credit-cart', 'color' => 'success'],
                    ['title' => 'Remaining Stock', 'value' => $summary['remaining_stock'], 'icon' => 'ki-shop', 'color' => 'info'],
                    ['title' => 'Revenue (₦)', 'value' => number_format($summary['total_paid'], 2), 'icon' => 'ki-wallet', 'color' => 'warning'],
                ];
            @endphp

            @foreach($cards as $card)
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body d-flex align-items-center">
                            <div class="symbol symbol-50px me-4 bg-light-{{ $card['color'] }}">
                                <i class="ki-duotone {{ $card['icon'] }} text-{{ $card['color'] }} fs-2x"></i>
                            </div>
                            <div>
                                <div class="text-gray-800 fw-bold fs-6">{{ $card['title'] }}</div>
                                <div class="fs-2hx fw-bolder text-{{ $card['color'] }}">{{ $card['value'] }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Low Stock Alert -->
        @php
            $lowStockProducts = $assignedProducts->filter(fn($p) => $p->quantity <= 5);
        @endphp
        @if($lowStockProducts->count())
            <div class="alert alert-warning d-flex align-items-center mb-6">
                <i class="ki-duotone ki-alert fs-2x me-3"></i>
                <div>
                    <strong>Low Stock Alert:</strong>
                    {{ $lowStockProducts->count() }} product(s) are running low. Restock soon.
                </div>
            </div>
        @endif

        <!-- Product Performance Table -->
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title fw-bold text-gray-900">📊 Product Performance</h3>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed gy-5">
                        <thead>
                            <tr class="text-gray-500 fw-bold text-uppercase fs-7">
                                <th>Product</th>
                                <th>Code</th>
                                <th>Initial Stock</th>
                                <th>Sold</th>
                                <th>Remaining</th>
                                <th>Sales Value</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($assignedProducts as $product)
                                <tr>
                                    <td class="fw-bold text-gray-900">{{ $product->name }}</td>
                                    <td>{{ $product->product_code ?? 'N/A' }}</td>
                                    <td>{{ $product->quantity + $product->total_sold }}</td>
                                    <td class="text-success fw-bold">{{ $product->total_sold }}</td>
                                    <td class="{{ $product->quantity <= 5 ? 'text-danger fw-bold' : '' }}">
                                        {{ $product->quantity }}
                                    </td>
                                    <td>₦{{ number_format($product->total_value, 2) }}</td>
                                    <td>
                                        @if($product->quantity <= 5)
                                            <span class="badge badge-light-danger">Low Stock</span>
                                        @else
                                            <span class="badge badge-light-success">In Stock</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">No products assigned.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $assignedProducts->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
