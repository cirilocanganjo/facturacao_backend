<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['invoice_id'])]

class Payment extends Model
{
    public function invoice () {
        return $this->belongsTo(Invoice::class);
    }
}
