<?php

namespace App\Http\Controllers;

use App\Http\Resources\LocationResource;
use App\Models\Location;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class DataController extends Controller
{
    public function index(): JsonResource
    {
        /**
         * @var Collection<Location> $locations
        */
        $locations = Location::query()->get();

        return LocationResource::collection($locations);
    }

    public function show(): View
    {
        return view('data');
    }
}
