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
                            <div class="row bg-info m-1 row-flex">
                                <div class="col col-flex col-auto font-weight-bold">
                                    <span class="text-body m-1">{{$item['season']->name}}</span>
                                    <span class="text-body m-1 ml-2">{{$item['league']->name}}</span>
                                </div>
                                <div class="col col-auto">
                                    <div class="card-button m-1">
                                        <a href="{{route('league_seasons.show', $item['league_season_id'])}}">
                                            <button class="btn btn-secondary">{{__('Show timetable')}}</button>
                                        </a>
                                    </div>
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

