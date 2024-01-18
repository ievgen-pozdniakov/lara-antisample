<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;

class Product extends Model
{
    use HasFactory;

    protected static function booted(): void
    {
        static::addGlobalScope('available', function (Builder $builder) {
            $builder->where('amount', '>', 0);
        });
    }

    public function orderProducts(): HasMany
    {
        return $this->hasMany(OrderProducts::class);
    }
}
