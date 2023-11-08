<?php

namespace App\Console\Commands;

use App\Models\Environment;
use App\Models\Location;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class GetData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-data';

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
        try {
            $disk           = Storage::disk('s3');
            $content        = $disk->get('weather.json');
            $data           = json_decode($content, true);

            $locationData   = [
                'city'      => $data['city'],
                'region'    => $data['region'],
                'country'   => $data['country'],
                'timezone'  => $data['timezone'],
            ];

            /**
             * @var Location $location
             */
            $location       = Location::query()->firstOrCreate([
                'city'      => $locationData['city'],
            ], $locationData);

            unset(
                $data['city'],
                $data['region'],
                $data['country'],
                $data['timezone'],
            );

            $data['location_id'] = $location->id;

            /**
             * @var Environment $environment
             */
            $environment    = Environment::query()->create($data);

            $this->info('Data got successfully. The Environment ID is ' . $environment->id);
        } catch (\Exception $error)
        {
            $this->error($error->getMessage());
        }
    }
}
