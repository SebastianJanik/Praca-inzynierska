@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Apply to the team') }}</div>

                    <div class="card-body">
                        <season-index></season-index>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
