<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'name',
    'nif',
    'address',
    'phone',
    'company_id'
])]


class Client extends Model
{
    public function company () {
        return $this->belongsTo(Company::class);
    }
}
