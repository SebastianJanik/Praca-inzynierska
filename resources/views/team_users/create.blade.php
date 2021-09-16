@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Apply to the team') }}</div>

                    <div class="card-body">
                        <apply-inputs></apply-inputs>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
