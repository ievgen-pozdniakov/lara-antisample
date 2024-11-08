<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class Category extends Model
{
    use HasFactory;

    protected static function booted(): void
    {
        static::addGlobalScope('active', function (Builder $builder) {
            $builder->where('is_active', '=', true);
        });
    }

    public static function createCategory($data)
    {
        $instance = new self();

        foreach ($data as $field => $value) {
            $instance->$field = $value;
        }
        $instance->save();

        return $instance;
    }
}
