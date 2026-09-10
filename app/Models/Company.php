<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'name',    
    'nif',
    'address',
    'phone',
    'email',
    'logo',
    'tax_regime',
    'invoice_prefix',
])]

class Company extends Model
{
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
