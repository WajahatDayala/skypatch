<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'required_format_id',
        'fabric_id',
        'placement_id',
        'status_id',
        'quote_id_edit',
        'edit_status',
        'description',
        'name',
        'height',
        'width',
        'number_of_colors',
        'super_urgent',
    ];
}
