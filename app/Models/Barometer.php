<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barometer extends Model
{
    use HasFactory;

    protected $casts = [
        'month' => 'date:M',
    ];

    protected $fillable = [
        'month',
        'points',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
