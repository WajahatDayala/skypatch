<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteFileLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'quote_id',
        'order_id',
        'vector_order_id',
        'cust_id',
        'emp_id',
        'files'
        
    ];
}
