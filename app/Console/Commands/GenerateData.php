<?php

namespace App\Console\Commands;

use App\Helper\App;
use Aws\IotDataPlane\IotDataPlaneClient;
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
    public function handle()
    {
        try {
            $iotClient = new IotDataPlaneClient([
                'version'       => 'latest',
                'region'        => env('AWS_DEFAULT_REGION'),

                'credentials'   => [
                    'key'       => env('AWS_ACCESS_KEY_ID'),
                    'secret'    => env('AWS_SECRET_ACCESS_KEY'),
                ],
            ]);

            $data = [
                'temperature'   => App::generateNumber(-30, 30),
                'windSpeed'     => App::generateNumber(10, 40),
                'humidity'      => App::generateNumber(0, 100),
            ];

            $topic = 'weather';
            $payload = json_encode($data);

            $iotClient->publish([
                'topic'     => $topic,
                'payload'   => $payload,
                'qos'       => 1,
            ]);

            $this->info('Data sent successfully');
        } catch (\Exception $error)
        {
            $this->error('Data not sent');
        }
    }
}
