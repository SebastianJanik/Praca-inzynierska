@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('Leagues') }}</div>

                    <div class="card-body">
                        @foreach($data as $league)
                            <div class="row-flex">
                                <span class="text-body">{{$loop->iteration}}.</span>
                                <span class="text-body"><a href="{{route('teams.teams_in_league_season', $league['league_season_id'])}}">{{$league['league']['name']}}</a></span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
