<?php

namespace App\Models;

use App\Models\Publication;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'publication_id',
        'is_primary',
    ];

    public function publication() {
        return $this->belongsTo(Publication::class);
    }
}
