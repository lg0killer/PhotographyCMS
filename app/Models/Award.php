<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    use HasFactory;

    public function photos()
    {
        return $this->belongsToMany(Photo::class, 'photo_awards', 'award_id', 'photo_id');
    }
}
