<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'required_format_id',
        'fabric_id',
        'placement_id',
        'edit_order_id',
        'edit_status',
        'description',
        'status_id',
        'name',
        'height',
        'width',
        'number_of_colors',
        'super_urgent',
        'delivery_type_id'
    ];
}
