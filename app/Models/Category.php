<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Photo;

class Category extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'description',
        'short_code'
    ];

    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class, 'category_id');
    }
}
