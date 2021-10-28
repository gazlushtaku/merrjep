<?php

namespace App\Models;

use App\Models\Image;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Publication extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'phone',
        'email',
        'price',
        'description',
        'total_views',
        'status',
        'slug'
    ];

    public function categories() {
        return $this->belongsToMany(Category::class);
    } 

    public function images() {
        return $this->hasMany(Image::class);
    }
}
