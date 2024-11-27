<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobInformation extends Model
{
    //
    protected $fillable = [
        'quote_id',
        'order_id',
        'vector_id',
        'height_A',
        'width_A',
        'stitches_A',
        'price_A',
        'height_B',
        'width_B',
        'stitches_B',
        'price_B',
        'total',
    ];
}
