@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('All leagues') }}</div>

                    <div class="card-body">
                        @foreach($leagues as $league)
                            <div class="row">
                                <div class="card">
                                    {{$loop->iteration}}.
                                </div>
                                <div class="card">
                                    {{$league->name}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

