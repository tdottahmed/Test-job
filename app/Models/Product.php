<?php

namespace App\Models;

use App\Models\Variation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function variations()
    {
        return $this->hasMany(Variation::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
