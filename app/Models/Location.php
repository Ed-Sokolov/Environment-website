<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'city',
        'region',
        'country',
        'timezone',
    ];

    public function environments(): HasMany
    {
        return $this->hasMany(Environment::class)->latest()->take(config('environment.count', 7));
    }
}
