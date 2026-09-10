<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['description', 
    'unit_price',
    'tax_rate',
    'unit',
    'category_id',
    'company_id',
])]

class Product extends Model
{
    public function company () {
        return $this->belongsTo(Company::class);
    }

    public function category () {
        return $this->belongsTo(Category::class);
    }
}
