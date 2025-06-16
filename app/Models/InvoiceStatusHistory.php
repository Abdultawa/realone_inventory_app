<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceStatusHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'status',
        'notes',
        'changed_by'
    ];

    protected $table = 'invoice_status_history';
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function changedBy()
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}
