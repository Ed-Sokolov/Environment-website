<?php

namespace App\Helper;

class App
{
    static public function generateDataForIoTCore(array $data): array
    {
        return [
            'city'              => $data['location']['name'],
            'region'            => $data['location']['region'],
            'country'           => $data['location']['country'],
            'timezone'          => $data['location']['tz_id'],

            'temp_c'            => $data['current']['temp_c'],
            'temp_f'            => $data['current']['temp_f'],
            'feelslike_c'       => $data['current']['feelslike_c'],
            'feelslike_f'       => $data['current']['feelslike_f'],

            'condition_title'   => $data['current']['condition']['text'],
            'condition_icon'    => $data['current']['condition']['icon'],
            'condition_code'    => $data['current']['condition']['code'],

            'wind_mph'          => $data['current']['wind_mph'],
            'wind_kph'          => $data['current']['wind_kph'],
            'wind_degree'       => $data['current']['wind_degree'],
            'wind_dir'          => $data['current']['wind_dir'],

            'pressure_mb'       => $data['current']['pressure_mb'],
            'pressure_in'       => $data['current']['pressure_in'],

            'precip_mm'         => $data['current']['precip_mm'],
            'precip_in'         => $data['current']['precip_in'],

            'humidity'          => $data['current']['humidity'],
            'cloud'             => $data['current']['cloud'],

            'is_day'            => $data['current']['is_day'],

            'uv'                => $data['current']['uv'],

            'gust_mph'          => $data['current']['gust_mph'],
            'gust_kph'          => $data['current']['gust_kph'],
        ];
    }

    static public function generateNumber(int $min, int $max): float
    {
        $randomNumber = rand($min * 100, $max * 100);
        return round($randomNumber / 100, 2);
    }
}
