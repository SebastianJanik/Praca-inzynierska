@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('All leagues') }}</div>

                    <div class="card-body">
                        @foreach($data as $league)
                            <div class="row">
                                <span>{{$loop->iteration}}.</span>
                                <a href="{{route('league_seasons.show', $league['league_season_id'])}}">{{$league['league']['name']}}</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
