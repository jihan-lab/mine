<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'users_id', 'categories_id', 'price', 'description', 'slug'
    ];

    protected $hidden = [];

    public function galleries()
    {
        return $this->hasMany(ProductGallery::class, 'products_id', 'id');
    }

    public function users()
    {
        return $this->hasOne(User::class, 'id', 'users_id');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, 'categories_id', 'id');
    }
}
