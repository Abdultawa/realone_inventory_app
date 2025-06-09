<?php


return [
    // Low stock threshold
    'low_stock_threshold' => env('LOW_STOCK_THRESHOLD', 10),

    // Inventory value currency
    'currency' => env('INVENTORY_CURRENCY','NGN'),

    // Dashboard settings
    'dashboard' => [
        'recent_days' => 7,
        'trend_days' => 30,
        'monthly_months' => 12,
    ],
];
