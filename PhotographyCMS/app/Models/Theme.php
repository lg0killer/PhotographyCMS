<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'month',
        'year',
    ];

    public function photos()
    {
        return $this->hasMany(Photo::class, 'theme_id');
    }
}
