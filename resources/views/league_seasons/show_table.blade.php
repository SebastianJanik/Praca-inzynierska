@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('Table') }}</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col">{{ __('Team') }}</div>
                            <div class="col">{{ __('Matches') }}</div>
                            <div class="col">{{ __('Points') }}</div>
                            <div class="col">{{ __('Goals scored') }}</div>
                            <div class="col">{{ __('Goals conceded') }}</div>
                            <div class="col">{{ __('Goals diff') }}</div>
                        </div>
                        @foreach($data as $team)
                        <div class="row">
                            <div class="col">
                                <a href="{{route('teams.show', $team->team->id)}}">
                                    {{$team->team->name}}
                                </a>
                            </div>
                            <div class="col">{{$team->count}}</div>
                            <div class="col">{{$team->points}}</div>
                            <div class="col">{{$team->goals_scored}}</div>
                            <div class="col">{{$team->goals_conceded}}</div>
                            <div class="col">{{$team->goals_diff}}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

