<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Product extends Model
{
    use Sluggable;

    public $fillable = ['title', 'category_id', 'excerpt', 'content', 'price', 'old_price', 'image', 'gallery',
        'is_hit', 'is_new'];

    protected function gallery(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? json_decode($value, true) : [],
            set: fn ($value) => $value ? json_encode($value) : null,
        );
    }

    public function getImage()
    {
        return $this->image
            ? asset($this->image)
            : asset('assets/img/no-image.png');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
