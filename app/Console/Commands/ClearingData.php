<?php

namespace App\Console\Commands;

use App\Models\Environment;
use App\Models\Location;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;

class ClearingData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clearing-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        /**
         * @var Collection<Location> $locations
         * @var int $maxEnvironmentCount
        */
        $locations              = Location::query()->get();
        $maxEnvironmentCount    = config('environment.count', 7);

        foreach ($locations as $location)
        {
            /**
             * @var Builder<Environment> $environmentsBuilder
             * @var int $environmentsCount
             */
            $environmentsBuilder    = Environment::query()->where('location_id', $location->id);
            $environmentsCount      = $environmentsBuilder->count();

            if ($environmentsCount > $maxEnvironmentCount)
            {
                $difference = $environmentsCount - $maxEnvironmentCount;

                $environmentsBuilder->take($difference)->delete();
            }
        }
    }
}
