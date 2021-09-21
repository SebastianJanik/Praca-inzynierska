@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Show timetable') }}</div>

                    <div class="card-body">
                        <timetable></timetable>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
