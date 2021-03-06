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
                                <span class="text-body">{{$league['league']['name']}}</span>
                                <span class="text-body  ml-3"><a href="{{route('teams.teams_in_league_season', $league['league_season']->id)}}">{{__('Teams')}}</a></span>
                                @if($league['timetable'])
                                <span class="text-body  ml-3"><a href="{{route('league_seasons.show', $league['league_season']->id)}}">{{__('Timetable')}}</a></span>
                                <span class="text-body  ml-3"><a href="{{route('league_seasons.show_table', $league['league_season']->id)}}">{{__('Table')}}</a></span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
