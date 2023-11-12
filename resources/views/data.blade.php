@extends('layouts.app')

@section('content')
    <div class="container p-3 text-uppercase">
        <div class="tab-wrapper d-flex align-items-start" data-init="tab">
            <div class="nav flex-column nav-pills me-3 gap-2" id="v-pills-tab" role="tablist" aria-orientation="vertical"></div>

            <div class="card w-100 p-3">
                <div class="tab-content" id="v-pills-tabContent"></div>
            </div>
        </div>
    </div>
@endsection
