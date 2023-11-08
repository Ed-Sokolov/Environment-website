<?php

namespace App\Console\Commands;

use App\Helper\App;
use Aws\IotDataPlane\IotDataPlaneClient;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class GenerateData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-data';

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
        $client = new Client([
            'verify' => false
        ]);

        $api    = env('WEATHER_API');
        $key    = env('WEATHER_API_KEY');
        $city   = env('WEATHER_API_CITY');
        $url    = "$api?key=$key&q=$city";

        try {
            $response   = $client->request('GET', $url);
            $data       = json_decode($response->getBody(), true);

            $iotClient  = new IotDataPlaneClient([
                'version'       => 'latest',
                'region'        => env('AWS_DEFAULT_REGION'),

                'credentials'   => [
                    'key'       => env('AWS_ACCESS_KEY_ID'),
                    'secret'    => env('AWS_SECRET_ACCESS_KEY'),
                ],
            ]);

            $data       = App::generateDataForIoTCore($data);

            $topic      = 'weather';
            $payload    = json_encode($data);

            $iotClient->publish([
                'topic'         => $topic,
                'payload'       => $payload,
                'qos'           => 1,
            ]);

            $this->info('Data sent successfully');
        } catch (\Exception $error)
        {
            $this->error($error->getMessage());
        }
    }
}
