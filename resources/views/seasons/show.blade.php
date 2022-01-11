@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('Leagues') }}</div>

                    <div class="card-body">
                        @foreach($data as $league)
                            <div class="row flex bg-info align-items-center d-flex m-1 p-1">
                                <span class="text-body col-auto">{{$loop->iteration}}.</span>
                                <span class="text-body font-weight-bold col-auto">{{$league['league']['name']}}</span>
                                <span class="text-body col-auto">
                                    <a href="{{route('teams.teams_in_league_season', $league['league_season']->id)}}">
                                        <button class="btn btn-secondary">{{__('Teams')}}</button>
                                    </a>
                                </span>
                                @if($league['timetable'])
                                <span class="text-body col-auto">
                                    <a href="{{route('league_seasons.show', $league['league_season']->id)}}">
                                        <button class="btn btn-secondary">{{__('Timetable')}}</button>
                                    </a>
                                </span>
                                <span class="text-body col-auto">
                                    <a href="{{route('league_seasons.show_table', $league['league_season']->id)}}">
                                        <button class="btn btn-secondary">{{__('Table')}}</button>
                                    </a>
                                </span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
