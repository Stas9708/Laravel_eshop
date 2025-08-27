<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'note',
        'total'
    ];

    public function orderProducts(): HasMany
    {
        return $this->hasMany(OrderProduct::class);
    }
}
