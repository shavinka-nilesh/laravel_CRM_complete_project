<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    // public function invoices()
    // {
    //     return $this->hasMany(Invoice::class);
    // }
    protected $fillable = [//we use fillable to store the data all once
        'name', //column names in the database
        'email',
        'phone',
        'address',
        'status',
    ];
}
