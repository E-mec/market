<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [

        // 'color_id',
        // 'size_id',
        'name',
        'slug',
        'category_id',
        'sub_category_id',
        'brand_id',
        'description',
        'range_id',


        'old_price',
        'new_price',
        'discount',
        'quantity',
        'hot',

        'is_available',
        'trending',
        'meta_title',
        'meta_keyword',
        'meta_description',
    ];

    // protected $cast = array('color_id');

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function range()
    {
        return $this->belongsTo(Range::class, 'range_id');
    }

    public function size()
    {
        return $this->belongsToMany(Size::class, 'size_product', 'product_id', 'size_id');
    }

    public function color()
    {
        return $this->belongsToMany(Color::class, 'color_product', 'product_id', 'color_id');
    }

    public function image() {
        return $this->hasOne(ProductImage::class);
    }
}
