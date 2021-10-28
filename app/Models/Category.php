<?php

namespace App\Models;

use App\Models\Publication;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
    ];

    public function publications() {
        return $this->belongsToMany(Publication::class);
    } 
}
