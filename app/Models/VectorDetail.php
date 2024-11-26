<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VectorDetail extends Model
{
    //
    protected $fillable = [
        'customer_id',
        'machine', 
        'condition', 
        'needles',
        'thread',
        'needle_brand',
        'backing_pique_jersey',
        'brand',
        'backing_cotton_twill',
        'backing_cap',
        'model',
        'needle_number',
        'head',
        'comment_box'

    ];
  
}
