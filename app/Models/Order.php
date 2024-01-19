<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    const STATUS_PLACED = 'placed';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_DELIVERED = 'delivered';
    const STATUS_FINISHED = 'finished';
    const STATUS_DECLINED = 'declined';

    use HasFactory;

    public function orderProducts(): HasMany
    {
        return $this->hasMany(OrderProducts::class);
    }

    public function shopper(): BelongsTo
    {
        return $this->belongsTo(Shopper::class);
    }
}
