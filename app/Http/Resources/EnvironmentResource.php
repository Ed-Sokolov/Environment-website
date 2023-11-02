<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EnvironmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'temp_c' => $this->temp_c,
            'temp_f' => $this->temp_f,
            'feelslike_c' => $this->feelslike_c,
            'feelslike_f' => $this->feelslike_f,

            'condition_title' => $this->condition_title,
            'condition_icon' => $this->condition_icon,
            'condition_code' => $this->condition_code,

            'wind_mph' => $this->wind_mph,
            'wind_kph' => $this->wind_kph,
            'wind_degree' => $this->wind_degree,
            'wind_dir' => $this->wind_dir,

            'pressure_mb' => $this->pressure_mb,
            'pressure_in' => $this->pressure_in,

            'precip_mm' => $this->precip_mm,
            'precip_in' => $this->precip_in,

            'humidity' => $this->humidity,
            'cloud' => $this->cloud,

            'is_day' => $this->is_day,

            'uv' => $this->uv,

            'gust_mph' => $this->gust_mph,
            'gust_kph' => $this->gust_kph,

            'created' => $this->created_at,
        ];
    }
}
