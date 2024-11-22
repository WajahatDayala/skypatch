<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingCriteria extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'minimum_price',
        'maximum_price', 
        'stitches',
        'editing_changes',
        'editing_in_stitch_file',
        'comment_box_1',
        'comment_box_2',
        'comment_box_3',
        'comment_box_4',
        'customer_id'
    ];
}
