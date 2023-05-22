<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Reltions\HasOne;
use App\Models\User;
use App\Models\Category;
use App\Models\Theme;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'category_id',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'by_user_id');
    }

    public function category(): BelongsTo
    {
        return $this->BelongsTo(Category::class, 'category_id');
    }

    public function theme(): HasOne
    {
        return $this->hasOne(Theme::class, 'theme_id');
    }
}
