<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Photo;

class StarLevel extends Model
{
    use HasFactory;

    protected $fillable=[
        'starlevel',
    ];

    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class, 'starlevel_id');
    }
}
