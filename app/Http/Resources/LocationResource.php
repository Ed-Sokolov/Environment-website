<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
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

            'city' => $this->city,
            'region' => $this->region,
            'country' => $this->country,
            'timezone' => $this->timezone,

            'environments' => EnvironmentResource::collection($this->environments)
        ];
    }
}
