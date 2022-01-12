@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="card-body">
                        <span class="text-success">{{ __('Season created') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
