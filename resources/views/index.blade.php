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
    <div class="container p-3 text-uppercase w">
        @if(count($locations) > 0)
            @foreach($locations as $location)
                <ul class="list-group mb-3">
                    <li class="list-group-item text-center">{{ $location->city }}</li>
                </ul>

                @if(count($location->environments) > 0)
                    <div class="row row-cols-1 row-cols-md-2 g-4 justify-content-center">
                        @foreach($location->environments as $environment)
                            <div class="col">
                                <div class="card text-center">
                                    <div class="card-header">
                                        <img src="{{ $environment->condition_icon }}" alt="{{ $environment->condition_title }}">
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                Temperature: {{ round($environment->temp_c) }}℃
                                            </li>
                                            <li class="list-group-item">
                                                It feels like: {{ round($environment->feelslike_c) }}℃
                                            </li>
                                            <li class="list-group-item">
                                                Humidity: {{ $environment->humidity }}%
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-footer text-body-secondary">
                                        {{ $environment->created_at }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @endforeach
        @else
            <div class="row justify-content-center text-center">
                <div class="row">
                    <div class="p-3 bg-warning-subtle rounded font-weight-bold fs-3 border border-3 border-warning">Empty</div>
                </div>
            </div>
        @endif
    </div>
</section>
</body>
</html>
