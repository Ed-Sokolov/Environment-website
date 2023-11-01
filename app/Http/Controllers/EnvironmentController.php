<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;

class EnvironmentController extends Controller
{
    public function index(): View
    {
        /**
         * @var Collection<Location> $locations
        */
        $locations = Location::query()->get();

        return view('index', compact('locations'));
    }
}
