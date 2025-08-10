<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inventory Dashboard') }}
        </h2>
    </x-slot>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::Row-->
            <div class="row gx-5 gx-xl-10 mb-xl-10">
                <!--begin::Col-->
                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-10">
                    <!--begin::Card widget 4-->
                    <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <div class="card-title d-flex flex-column">
                                <!--begin::Info-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Amount-->
                                    <span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2">{{ $totalProducts }}</span>
                                    <!--end::Amount-->
                                    <!--begin::Badge-->
                                    <span class="badge badge-light-{{ $productsChange >= 0 ? 'success' : 'danger' }} fs-base">
                                        <i class="ki-outline ki-arrow-{{ $productsChange >= 0 ? 'up' : 'down' }} fs-5 text-{{ $productsChange >= 0 ? 'success' : 'danger' }} ms-n1"></i>
                                        {{ abs($productsChange) }}%
                                    </span>
                                    <!--end::Badge-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Subtitle-->
                                <span class="text-gray-500 pt-1 fw-semibold fs-6">Total Products in Inventory</span>
                                <!--end::Subtitle-->
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-2 pb-4 d-flex align-items-center">
                            <!--begin::Chart-->
                            <div class="d-flex flex-center me-5 pt-2">
                                <div id="kt_card_widget_4_chart" style="min-width: 70px; min-height: 70px" data-kt-size="70" data-kt-line="11"></div>
                            </div>
                            <!--end::Chart-->
                            <!--begin::Labels-->
                            <div class="d-flex flex-column content-justify-center w-100">
                                @foreach($categoryCounts as $categoryName => $count)
                                <!--begin::Label-->
                                <div class="d-flex fs-6 fw-semibold align-items-center {{ !$loop->first ? 'my-3' : '' }}">
                                    <!--begin::Bullet-->
                                    <div class="bullet w-8px h-6px rounded-2 bg-{{ ['danger', 'primary', 'success', 'warning', 'info'][$loop->index % 5] }} me-3"></div>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-500 flex-grow-1 me-4">{{ $categoryName }}</div>
                                    <!--end::Label-->
                                    <!--begin::Stats-->
                                    <div class="fw-bolder text-gray-700 text-xxl-end">{{ $count }}</div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Label-->
                                @endforeach
                            </div>
                            <!--end::Labels-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 4-->
                    <!--begin::Card widget 5-->
                    <div class="card card-flush h-md-50 mb-xl-10">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <div class="card-title d-flex flex-column">
                                <!--begin::Info-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Amount-->
                                    <span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2">{{ $lowStockProducts }}</span>
                                    <!--end::Amount-->
                                    <!--begin::Badge-->
                                    <span class="badge badge-light-{{ $lowStockChange >= 0 ? 'danger' : 'success' }} fs-base">
                                        <i class="ki-outline ki-arrow-{{ $lowStockChange >= 0 ? 'up' : 'down' }} fs-5 text-{{ $lowStockChange >= 0 ? 'danger' : 'success' }} ms-n1"></i>
                                        {{ abs($lowStockChange) }}%
                                    </span>
                                    <!--end::Badge-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Subtitle-->
                                <span class="text-gray-500 pt-1 fw-semibold fs-6">Low Stock Products</span>
                                <!--end::Subtitle-->
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body d-flex align-items-end pt-0">
                            <!--begin::Progress-->
                            <div class="d-flex align-items-center flex-column mt-3 w-100">
                                <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                    <span class="fw-bolder fs-6 text-gray-900">Threshold: {{ $lowStockThreshold }} items</span>
                                    <span class="fw-bold fs-6 text-gray-500">{{ $lowStockPercentage }}% of inventory</span>
                                </div>
                                <div class="h-8px mx-3 w-100 bg-light-danger rounded">
                                    <div class="bg-danger rounded h-8px" role="progressbar" style="width: {{ $lowStockPercentage }}%;" aria-valuenow="{{ $lowStockPercentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <!--end::Progress-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 5-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-10">
                    <!--begin::Card widget 6-->
                    <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <div class="card-title d-flex flex-column">
                                <!--begin::Info-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Currency-->
                                    <span class="fs-4 fw-semibold text-gray-500 me-1 align-self-start">₦</span>
                                    <!--end::Currency-->
                                    <!--begin::Amount-->
                                    <span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2">{{ number_format($totalValue, 2) }}</span>
                                    <!--end::Amount-->
                                    <!--begin::Badge-->
                                    <span class="badge badge-light-{{ $valueChange >= 0 ? 'success' : 'danger' }} fs-base">
                                        <i class="ki-outline ki-arrow-{{ $valueChange >= 0 ? 'up' : 'down' }} fs-5 text-{{ $valueChange >= 0 ? 'success' : 'danger' }} ms-n1"></i>
                                        {{ abs($valueChange) }}%
                                    </span>
                                    <!--end::Badge-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Subtitle-->
                                <span class="text-gray-500 pt-1 fw-semibold fs-6">Total Inventory Value</span>
                                <!--end::Subtitle-->
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body d-flex align-items-end px-0 pb-0">
                            <!--begin::Chart-->
                            <div id="kt_card_widget_6_chart" class="w-100" style="height: 80px"></div>
                            <!--end::Chart-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 6-->
                    <!--begin::Card widget 7-->
                    <div class="card card-flush h-md-50 mb-xl-10">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <div class="card-title d-flex flex-column">
                                <!--begin::Amount-->
                                <span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2">{{ $recentlyAdded }}</span>
                                <!--end::Amount-->
                                <!--begin::Subtitle-->
                                <span class="text-gray-500 pt-1 fw-semibold fs-6">Recently Added Products</span>
                                <!--end::Subtitle-->
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body d-flex flex-column justify-content-end pe-0">
                            <!--begin::Title-->
                            <span class="fs-6 fw-bolder text-gray-800 d-block mb-2">Latest Additions</span>
                            <!--end::Title-->
                            <!--begin::Products group-->
                            <div class="symbol-group symbol-hover flex-nowrap">
                                @foreach($recentProducts as $product)
                                <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="{{ $product->name }} (Added: {{ $product->created_at->format('M d') }})">
                                    <span class="symbol-label bg-{{ ['primary', 'success', 'info', 'warning', 'danger'][$loop->index % 5] }} text-inverse-{{ ['primary', 'success', 'info', 'warning', 'danger'][$loop->index % 5] }} fw-bold">
                                        {{ strtoupper(substr($product->name, 0, 1)) }}
                                    </span>
                                </div>
                                @endforeach
                                @if(count($recentProducts) > 5)
                                <a href="{{ route('products.index') }}" class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="View All Products">
                                    <span class="symbol-label bg-light text-gray-400 fs-8 fw-bold">+{{ count($recentProducts) - 5 }}</span>
                                </a>
                                @endif
                            </div>
                            <!--end::Products group-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 7-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-lg-12 col-xl-12 col-xxl-6 mb-5 mb-xl-0">
                    <!--begin::Chart widget 3-->
                    <div class="card card-flush overflow-hidden h-md-100">
                        <!--begin::Header-->
                        <div class="card-header py-5">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-900">Inventory Value Trend</span>
                                <span class="text-gray-500 mt-1 fw-semibold fs-6">Last 30 days</span>
                            </h3>
                            <!--end::Title-->
                            <!--begin::Toolbar-->
                            <div class="card-toolbar">
                                <!--begin::Menu-->
                                <button class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                    <i class="ki-outline ki-dots-square fs-1"></i>
                                </button>
                                <!--begin::Menu 2-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Quick Actions</div>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu separator-->
                                    <div class="separator mb-3 opacity-75"></div>
                                    <!--end::Menu separator-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="{{ route('products.create') }}" class="menu-link px-3">Add New Product</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Generate Report</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu separator-->
                                    <div class="separator mt-3 opacity-75"></div>
                                    <!--end::Menu separator-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <div class="menu-content px-3 py-3">
                                            <a class="btn btn-primary btn-sm px-4" href="#">Export Data</a>
                                        </div>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu 2-->
                                <!--end::Menu-->
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body d-flex justify-content-between flex-column pb-1 px-0">
                            <!--begin::Statistics-->
                            <div class="px-9 mb-5">
                                <!--begin::Statistics-->
                                <div class="d-flex mb-2">
                                    <span class="fs-4 fw-semibold text-gray-500 me-1">₦</span>
                                    <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2">{{ number_format($monthlyValue, 2) }}</span>
                                </div>
                                <!--end::Statistics-->
                                <!--begin::Description-->
                                <span class="fs-6 fw-semibold text-gray-500">{{ $valueTrendDescription }}</span>
                                <!--end::Description-->
                            </div>
                            <!--end::Statistics-->
                            <!--begin::Chart-->
                            <div id="kt_charts_widget_3" class="min-h-auto ps-4 pe-6" style="height: 300px"></div>
                            <!--end::Chart-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Chart widget 3-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row gy-5 g-xl-10">
                <!--begin::Col-->
                <div class="">
                    <!--begin::Table Widget 5-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Card header-->
                        <div class="card-header pt-7">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-900">Stock Report</span>
                                <span class="text-gray-500 mt-1 fw-semibold fs-6">Total {{ $totalProducts }} Products in Inventory</span>
                            </h3>
                            <!--end::Title-->
                            <!--begin::Actions-->
                            <div class="card-toolbar">
                                <!--begin::Filters-->
                                <div class="d-flex flex-stack flex-wrap gap-4">
                                    <!--begin::Destination-->
                                    <div class="d-flex align-items-center fw-bold">
                                        <!--begin::Label-->
                                        <div class="text-muted fs-7 me-2">Category</div>
                                        <!--end::Label-->
                                        <!--begin::Select-->
                                        <select class="form-select form-select-transparent text-gray-900 fs-7 lh-1 fw-bold py-0 ps-3 w-auto" data-control="select2" data-hide-search="true" data-dropdown-css-class="w-150px" data-placeholder="Select an option" id="categoryFilter">
                                            <option></option>
                                            <option value="Show All" selected="selected">Show All</option>
                                            @foreach($categories as $category)
                                            <option value="{{ $category->name }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        <!--end::Select-->
                                    </div>
                                    <!--end::Destination-->
                                    <!--begin::Status-->
                                    <div class="d-flex align-items-center fw-bold">
                                        <!--begin::Label-->
                                        <div class="text-muted fs-7 me-2">Status</div>
                                        <!--end::Label-->
                                        <!--begin::Select-->
                                        <select class="form-select form-select-transparent text-gray-900 fs-7 lh-1 fw-bold py-0 ps-3 w-auto" data-control="select2" data-hide-search="true" data-dropdown-css-class="w-150px" data-placeholder="Select an option" id="statusFilter">
                                            <option></option>
                                            <option value="Show All" selected="selected">Show All</option>
                                            <option value="In Stock">In Stock</option>
                                            <option value="Out of Stock">Out of Stock</option>
                                            <option value="Low Stock">Low Stock</option>
                                        </select>
                                        <!--end::Select-->
                                    </div>
                                    <!--end::Status-->
                                    <!--begin::Search-->
                                    <a href="{{ route('products.index') }}" class="btn btn-light btn-sm">View All Products</a>
                                    <!--end::Search-->
                                </div>
                                <!--begin::Filters-->
                            </div>
                            <!--end::Actions-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-dashed fs-6 gy-3" id="inventoryTable">
                                <!--begin::Table head-->
                                <thead>
                                    <!--begin::Table row-->
                                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="min-w-150px">Product</th>
                                        <th class="text-end pe-3 min-w-100px">Product Code</th>
                                        <th class="text-end pe-3 min-w-100px">Store</th>
                                        <th class="text-end pe-3 min-w-150px">Date Added</th>
                                        <th class="text-end pe-3 min-w-100px">Price</th>
                                        <th class="text-end pe-3 min-w-100px">Status</th>
                                        <th class="text-end pe-0 min-w-75px">Qty</th>
                                    </tr>
                                    <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="fw-bold text-gray-600">
                                    @foreach($inventoryProducts as $product)
                                    <tr>
                                        <!--begin::Item-->
                                        <td>
                                            <a href="{{ route('products.show', $product->id) }}" class="text-gray-900 text-hover-primary">{{ $product->name }}</a>
                                        </td>
                                        <!--end::Item-->
                                        <!--begin::Product ID-->
                                        <td class="text-end">#{{ $product->product_code }}</td>
                                        <!--end::Product ID-->
                                        <!--begin::Store-->
                                        <td class="text-end">{{ $product->store->name ?? 'N/A' }}</td>
                                        <!--end::Store-->   
                                        <!--begin::Date added-->
                                        <td class="text-end">{{ $product->created_at->format('d M, Y') }}</td>
                                        <!--end::Date added-->
                                        <!--begin::Price-->
                                        <td class="text-end">₦{{ number_format($product->price, 2) }}</td>
                                        <!--end::Price-->
                                        <!--begin::Status-->
                                        <td class="text-end">
                                            @if($product->quantity == 0)
                                            <span class="badge py-3 px-4 fs-7 badge-light-danger">Out of Stock</span>
                                            @elseif($product->quantity <= $lowStockThreshold)
                                            <span class="badge py-3 px-4 fs-7 badge-light-warning">Low Stock</span>
                                            @else
                                            <span class="badge py-3 px-4 fs-7 badge-light-primary">In Stock</span>
                                            @endif
                                        </td>
                                        <!--end::Status-->
                                        <!--begin::Qty-->
                                        <td class="text-end" data-order="{{ $product->quantity }}">
                                            <span class="text-gray-900 fw-bold">{{ $product->quantity }} PCS</span>
                                        </td>
                                        <!--end::Qty-->
                                    </tr>
                                    @endforeach
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Table Widget 5-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Content container-->
    </div>

    @push('scripts')
    <script>
        // Initialize charts and tables when the DOM is fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize the inventory table with DataTables
            const inventoryTable = $('#inventoryTable').DataTable({
                responsive: true,
                order: [[2, 'desc']], // Default sort by date added
                dom: '<"row"<"col-sm-6"l><"col-sm-6"f>>' +
                     '<"row"<"col-sm-12"tr>>' +
                     '<"row"<"col-sm-5"i><"col-sm-7"p>>',
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search products...",
                }
            });

            // Filter by category
            $('#categoryFilter').on('change', function() {
                const categoryName = $(this).val();
                if (categoryName === 'Show All') {
                    inventoryTable.columns(0).search('').draw();
                } else {
                    inventoryTable.columns(0).search(categoryName).draw();
                }
            });

            // Filter by status
            $('#statusFilter').on('change', function() {
                const status = $(this).val();
                if (status === 'Show All') {
                    inventoryTable.columns(4).search('').draw();
                } else {
                    inventoryTable.columns(4).search(status).draw();
                }
            });

            // Category distribution chart (Card Widget 4)
            const categoryChartElement = document.getElementById('kt_card_widget_4_chart');
            if (categoryChartElement) {
                const categories = @json(array_keys($categoryCounts));
                const categoryData = @json(array_values($categoryCounts));

                const categoryChart = new ApexCharts(categoryChartElement, {
                    series: categoryData,
                    chart: {
                        type: 'radialBar',
                        height: 70,
                        width: 70,
                        sparkline: {
                            enabled: true
                        }
                    },
                    plotOptions: {
                        radialBar: {
                            hollow: {
                                margin: 0,
                                size: '65%'
                            },
                            dataLabels: {
                                show: false
                            },
                            track: {
                                background: '#E4E6EF',
                                strokeWidth: '100%',
                                margin: 5
                            }
                        }
                    },
                    colors: ['#F64E60', '#3699FF', '#50CD89', '#E4E6EF', '#7239EA'],
                    stroke: {
                        lineCap: 'round'
                    },
                    labels: categories
                });
                categoryChart.render();
            }

            // Inventory value chart (Card Widget 6)
            const valueChartElement = document.getElementById('kt_card_widget_6_chart');
            if (valueChartElement) {
                const valueChart = new ApexCharts(valueChartElement, {
                    series: [{
                        name: 'Value',
                        data: @json($monthlyValueData)
                    }],
                    chart: {
                        type: 'area',
                        height: 80,
                        sparkline: {
                            enabled: true
                        }
                    },
                    stroke: {
                        curve: 'smooth',
                        width: 2
                    },
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shadeIntensity: 0.5,
                            opacityFrom: 0.7,
                            opacityTo: 0,
                            stops: [0, 80, 100]
                        }
                    },
                    colors: ['#3699FF'],
                    tooltip: {
                        fixed: {
                            enabled: false
                        },
                        x: {
                            show: false
                        },
                        y: {
                            formatter: function(val) {
                                return '₦' + val.toFixed(2)
                            }
                        },
                        marker: {
                            show: false
                        }
                    }
                });
                valueChart.render();
            }

            // Inventory trend chart (Chart Widget 3)
            const trendChartElement = document.getElementById('kt_charts_widget_3');
            if (trendChartElement) {
                const trendChart = new ApexCharts(trendChartElement, {
                    series: [{
                        name: 'Inventory Value',
                        data: @json($trendData)
                    }],
                    chart: {
                        type: 'line',
                        height: 300,
                        toolbar: {
                            show: false
                        }
                    },
                    stroke: {
                        curve: 'smooth',
                        width: 3
                    },
                    colors: ['#3699FF'],
                    xaxis: {
                        categories: @json($trendDates),
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false
                        },
                        labels: {
                            style: {
                                colors: '#A1A5B7',
                                fontSize: '12px'
                            }
                        },
                        crosshairs: {
                            position: 'front',
                            stroke: {
                                color: '#3699FF',
                                width: 1,
                                dashArray: 3
                            }
                        },
                        tooltip: {
                            enabled: true,
                            formatter: undefined,
                            offsetY: 0,
                            style: {
                                fontSize: '12px'
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            style: {
                                colors: '#A1A5B7',
                                fontSize: '12px'
                            },
                            formatter: function(val) {
                                return '₦' + val.toFixed(2);
                            }
                        }
                    },
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shade: 'dark',
                            gradientToColors: ['#3699FF'],
                            shadeIntensity: 1,
                            type: 'vertical',
                            opacityFrom: 0.7,
                            opacityTo: 0.1,
                            stops: [0, 100]
                        }
                    },
                    grid: {
                        borderColor: '#E4E6EF',
                        strokeDashArray: 4,
                        yaxis: {
                            lines: {
                                show: true
                            }
                        }
                    },
                    markers: {
                        size: 5,
                        colors: ['#3699FF'],
                        strokeColors: '#ffffff',
                        strokeWidth: 2,
                        hover: {
                            size: 7
                        }
                    },
                    tooltip: {
                        theme: 'light',
                        y: {
                            formatter: function(val) {
                                return '₦' + val.toFixed(2)
                            }
                        }
                    }
                });
                trendChart.render();
            }
        });
    </script>
    @endpush
</x-app-layout>
