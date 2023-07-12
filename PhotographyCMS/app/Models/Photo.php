<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Reltions\HasOne;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Category;
use App\Models\Theme;
use App\Models\Award;

class Photo extends Model
{
    use HasFactory;

    protected $casts = [
        'submitted_at' => 'date:m Y',
        'image_path' => 'string',
    ];

    protected $fillable = [
        'name',
        'description',
        'image',
        'category_id',
        'image_path',
        'submitted_at',
    ];

    protected function name(): Attribute {
        return Attribute::make(
            get: fn (string $value) => Str::of($value)->title(),
            set: fn (string $value) => Str::of($value)->title(),
        );
    }

    protected function imagePath(): Attribute {
        return Attribute::make(
            //get: fn (string $value) => asset("storage/".$value),
            get: fn (string $value) => asset($value),
            set: fn (string $value) => $value,
        );
    }

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

    public function awards()
    {
        return $this->belongsToMany(Award::class, 'photo_awards', 'photo_id', 'award_id');
    }

}
