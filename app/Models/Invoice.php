<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['invoice_item_id'])]

class Invoice extends Model
{
    public function invoiceItem () {
        return $this->belongsTo(InvoiceItem::class);
    }
}
