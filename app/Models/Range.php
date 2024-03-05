<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Range extends Model
{
    use HasFactory;

    protected $table = 'ranges';

    protected $fillable = [
        'price_range'
    ];

    public function products() {
        return $this->hasMany(Product::class);
        }
}
