<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Invoice;
class InvoiceDetail extends Model
{
    // 
    protected $fillable = [
            'invoice_id',
            'order_id',
            'vector_id',
            'price'
       
    ];

      // Define inverse relationship with Invoice
      public function invoice()
      {
          return $this->belongsTo(Invoice::class);
      }
}
