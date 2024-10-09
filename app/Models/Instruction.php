<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instruction extends Model
{
    use HasFactory;
    protected $fillable = [
        'cust_id',
        'emp_id',
        'description',
        'quote_id',
        'order_id',
        'vector_id',
    ];
}
