<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [//we use fillable to store the data all once
     //column names in the database
        'invoice_number',
        'invoice_date',
        'customer_name',
        'amount',
        'status',

    ];
    // public function invoice()
    // {
    //     return $this->belongsTo(Invoice::class);
    // }

}
