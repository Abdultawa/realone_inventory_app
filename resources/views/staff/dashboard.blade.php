<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-bold fs-3 text-gray-800">Welcome, {{ $staff->name }}</h2>
    </x-slot>

    <div class="container-xxl">
        <!-- Filters -->
        <div class="card mb-7">
            <div class="card-body">
                <form method="GET" action="{{ route('staff.dashboard') }}" class="row g-4 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Start Date</label>
                        <input type="date" name="start_date" value="{{ $startDate }}" class="form-control form-control-solid" />
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">End Date</label>
                        <input type="date" name="end_date" value="{{ $endDate }}" class="form-control form-control-solid" />
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="ki-duotone ki-filter fs-3 me-1"></i> Filter
                        </button>
                    </div>
                    <div class="col-md-3 text-end">
                        <span class="text-gray-500 fw-semibold">Showing data from <strong>{{ $startDate }}</strong> to <strong>{{ $endDate }}</strong></span>
                    </div>
                </form>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="row g-6 mb-6">
            @php
                $cards = [
                    ['title' => 'Assigned Products', 'value' => $summary['total_assigned'], 'icon' => 'ki-box', 'color' => 'primary'],
                    ['title' => 'Products Sold', 'value' => $summary['total_sold'], 'icon' => 'ki-credit-cart', 'color' => 'success'],
                    ['title' => 'Remaining Stock', 'value' => $summary['remaining_stock'], 'icon' => 'ki-shop', 'color' => 'info'],
                    ['title' => 'Paid / Unpaid', 'value' => '₦' . number_format($summary['total_paid'], 2) . ' / ₦' . number_format($summary['total_unpaid'], 2), 'icon' => 'ki-wallet', 'color' => 'warning'],
                ];
            @endphp

            @foreach($cards as $card)
                <div class="col-md-3">
                    <div class="card card-flush card-{{ $card['color'] }} bg-light-{{ $card['color'] }}">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-{{ $card['color'] }} fw-bold fs-6">{{ $card['title'] }}</div>
                                <div class="fs-2hx fw-bolder text-gray-800">{{ $card['value'] }}</div>
                            </div>
                            <div class="symbol symbol-50px bg-{{ $card['color'] }}">
                                <i class="ki-duotone {{ $card['icon'] }} text-white fs-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Product Performance Table -->
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title fw-bold text-gray-900">Product Performance</h3>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                        <thead class="text-gray-600 fw-bold">
                            <tr>
                                <th>Product</th>
                                <th>Code</th>
                                <th>Initial Stock</th>
                                <th>Sold</th>
                                <th>Remaining</th>
                                <th>Sales Value (₦)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($assignedProducts as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->product_code ?? 'N/A' }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ $product->total_sold }}</td>
                                    <td>{{ $product->quantity - $product->total_sold }}</td>
                                    <td>₦{{ number_format($product->total_value, 2) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">No assigned products found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- <div>
                        {{$assignedProducts->links()}}
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
