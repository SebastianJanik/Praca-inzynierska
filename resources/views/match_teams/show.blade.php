@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Timetable') }}</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="card">
                            </div>
                            <div class="card">
                            </div>
                        </div>
                    </div>
                    @foreach($data as $round)
                        <div class="card-header">{{$loop->iteration}}</div>
                        <div class="card-body">
                            @foreach($round['matches'] as $match)
                                    <div class="row">
                                        {{$match['match_teams'][0]['team']['name']}}
                                        {{$match['match_teams'][0]['goals']}}
                                        @if($match['match_teams'][0]['goals'] == null)
                                            X
                                        @endif
                                        -
                                        @if($match['match_teams'][1]['goals'] == null)
                                            X
                                        @endif
                                        {{$match['match_teams'][0]['goals']}}
                                        {{$match['match_teams'][1]['team']['name']}}
                                        <a href="{{route('home')}}">
                                            <button>{{__('View details')}}</button>
                                        </a>
                                        <a href="{{route('matches_edit', $match['match']['id'])}}">
                                            <button>{{__('Edit match')}}</button>
                                        </a>
                                    </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

