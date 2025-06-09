<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'store_id',
        'name',
        'description',
        'price',
        'quantity',
        'status',
        'product_code',
        'category_id',
    ];
     public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_user_id');
    }

    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class);
    }
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function getStatusAttribute()
    {
        if ($this->quantity === 0) {
            return 'Out of Stock';
        }

        if ($this->quantity <= 10) {
            return 'Low Stock';
        }

        return 'In Stock';
    }
    public function getStockStatusAttribute()
    {
        $lowStockThreshold = config('inventory.low_stock_threshold', 10);

        if ($this->quantity == 0) {
            return 'Out of Stock';
        } elseif ($this->quantity <= $lowStockThreshold) {
            return 'Low Stock';
        }
        return 'In Stock';
    }
    public function scopeByStockStatus($query, $status)
    {
        return match ($status) {
            'In Stock' => $query->where('quantity', '>', 10),
            'Low Stock' => $query->whereBetween('quantity', [1, 10]),
            'Out of Stock' => $query->where('quantity', '=', 0),
            default => $query,
        };
    }
}
