@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('All seasons') }}</div>

                    <div class="card-body">
                        @foreach($seasons as $season)
                        <div class="row">
                            <span>{{$loop->iteration}}.</span>
                            <a href="{{route('seasons.show', $season->id)}}">{{$season->name}}</a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
