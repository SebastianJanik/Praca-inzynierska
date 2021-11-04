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
                        </div>
                        @foreach($data as $team)
                        <div class="row">
                            <div class="col">{{$team->team->name}}</div>
                            <div class="col">{{$team->count}}</div>
                            <div class="col">{{$team->points}}</div>
                            <div class="col">{{$team->goals_scored}}</div>
                            <div class="col">{{$team->goals_conceded}}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

