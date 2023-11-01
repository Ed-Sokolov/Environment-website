<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Environment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'location_id',

        'temp_c',
        'temp_f',
        'feelslike_c',
        'feelslike_f',

        'condition_title',
        'condition_icon',
        'condition_code',

        'wind_mph',
        'wind_kph',
        'wind_degree',
        'wind_dir',

        'pressure_mb',
        'pressure_in',

        'precip_mm',
        'precip_in',

        'humidity',
        'cloud',

        'is_day',

        'uv',

        'gust_mph',
        'gust_kph',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
