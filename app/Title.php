<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    protected $fillable = ['name'];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
