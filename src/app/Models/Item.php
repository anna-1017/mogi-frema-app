<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable=['name', 'brand_name', 'price', 'description', 'condition', 'status', 'img_url'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_items');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'likes', 'item_id', 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function soldItem()
    {
        return $this->hasOne(SoldItem::class);
    }

    public function scopeSearch($query, $keyword)
    {
        if(!empty($keyword)){
            $query->where('name', 'like', "%{$keyword}%" );
        }
        return $query;
    }
}
