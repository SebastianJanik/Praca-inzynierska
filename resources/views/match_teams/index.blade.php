@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('All timetables') }}</div>

                    <div class="card-body">
                        @foreach($data as $item)
                            <div class="row">
                                <div class="card">
                                    {{$item['season']->name}}
                                    {{$item['league']->name}}
                                </div>
                                <div class="card-button">
                                    <a href="{{route('league.seasons.show', $item['league_season_id'])}}">
                                        <button>{{__('Show timetable')}}</button>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

