<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Product extends Model
{

    protected function gallery(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? json_decode($value, true) : [],
            set: fn ($value) => $value ? json_encode($value) : null,
        );
    }

    public function getImage()
    {
        return $this->image ?: 'assets/img/no-image.png';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
