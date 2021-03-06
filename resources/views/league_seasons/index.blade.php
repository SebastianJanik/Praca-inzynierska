@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('All timetables') }}</div>

                    <div class="card-body">
                        @if($data)
                        @foreach($data as $item)
                            <div class="row">
                                <div class="card" id="all_timetables_row">
                                    {{$item['season']->name}}
                                    {{$item['league']->name}}
                                </div>
                                <div class="card-button" id="all_timetables" >
                                    <a href="{{route('league_seasons.show', $item['league_season_id'])}}">
                                        <button class="btn btn-primary">{{__('Show timetable')}}</button>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

