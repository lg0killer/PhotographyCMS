<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

class Award extends Model
{
    use HasFactory;

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Str::of($value)->headline(),
        );
    }

    public function photos()
    {
        return $this->belongsToMany(Photo::class, 'photo_awards', 'award_id', 'photo_id');
    }
}
