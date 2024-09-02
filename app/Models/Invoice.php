<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [//we use fillable to store the data all once
        'invoice_number', //column names in the database
        'invoice_date',
        'customer_name',
        'email',
        'item_description',
        'amount',
    ];
    const STATUS_PENDING = 'pending';
    const STATUS_ACCEPTED = 'paid';
    const STATUS_REJECTED = 'cancelled';
    // public function transactions()
    // {
    //     return $this->hasMany(Transaction::class);
    // }
}
