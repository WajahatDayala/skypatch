<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\InvoiceDetail;
class Invoice extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'invoice_status'
    ];

     // Define the relationship with invoice_details
     public function details()
     {
         return $this->hasMany(InvoiceDetail::class);
     }
}

