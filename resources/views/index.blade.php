<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<section>
    <div class="container p-3">
        @if($data)
            <div class="card text-center">
                <div class="card-header">
                    Data
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            Temperature: {{ $data['temperature'] }}
                        </li>
                        <li class="list-group-item">
                            Wind speed: {{ $data['windSpeed'] }}
                        </li>
                        <li class="list-group-item">
                            Humidity: {{ $data['humidity'] }}
                        </li>
                    </ul>
                </div>
            </div>
        @endif
    </div>
</section>
</body>
</html>
