<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerBillInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'card_holder_name',
        'card_type_id',
        'card_number',
        'card_expiry',
        'vcc',
        'address',
        'city',
        'state',
        'zipcode',
        'country'
    ];
}
