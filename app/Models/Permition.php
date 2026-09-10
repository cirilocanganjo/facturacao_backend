<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['role_id'])]

class Permition extends Model
{
    public function role () {
        return $this->belongsTo(Role::class);
    }
}
