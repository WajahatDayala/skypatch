<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = [
        'role_id',
        'employee_id',
        'quote_id',
        'order_id',
        'vector_order_id',
        'option_type',
        'comment',
        'file_upload',
   
    ];

    use HasFactory;
}
