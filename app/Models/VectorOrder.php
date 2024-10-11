<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VectorOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'required_format_id',
        'status_id',
        'name',
        'number_of_colors',
    ];
}
