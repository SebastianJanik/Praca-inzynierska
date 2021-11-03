@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('Timetable') }}</div>
                    @foreach($data as $round)
                        <div class="card-header">{{$loop->iteration}}</div>
                        <div class="card-body">
                            @foreach($round->matches as $match)
                                <div class="row">
                                    <div class="col">
                                        {{$match->match_teams[0]->team->name}}
                                        @if($match->match_teams[0]->goals == null)

                                        @else
                                            {{$match->match_teams[0]->goals}}
                                        @endif
                                        -
                                        @if($match->match_teams[1]->goals == null)

                                        @else
                                            {{$match->match_teams[1]->goals}}
                                        @endif
                                        {{$match->match_teams[1]->team->name}}
                                    </div>
                                    @if($match->match_teams[0]->team->name != 'PAUSE' && $match->match_teams[1]->team->name != 'PAUSE')
                                        <div class="col">
                                            <a href="{{route('home')}}">
                                                <button>{{__('View details')}}</button>
                                            </a>
                                            @if($match->match->status_id != 9)
                                                @role('referee')
                                                <a href="{{route('matches.edit', $match->match->id)}}">
                                                    <button>{{__('Edit match')}}</button>
                                                </a>
                                                @endrole
                                            @endif
                                            @role('admin')
                                                <a href="{{route('matches.edit', $match->match->id)}}">
                                                    <button>{{__('Edit match')}}</button>
                                                </a>
                                            @endrole
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

