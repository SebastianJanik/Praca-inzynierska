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
                                        @if($match->match_teams[0]->team->name != 'PAUSE')
                                            <a href="{{route('teams.show', $match->match_teams[0]->team->id)}}">
                                                {{$match->match_teams[0]->team->name}}
                                            </a>
                                        @else
                                            {{$match->match_teams[0]->team->name}}
                                        @endif
                                        @if($match->match_teams[0]->goals == null)

                                        @else
                                            {{$match->match_teams[0]->goals}}
                                        @endif
                                        -
                                        @if($match->match_teams[1]->goals == null)

                                        @else
                                            {{$match->match_teams[1]->goals}}
                                        @endif
                                        @if($match->match_teams[1]->team->name != 'PAUSE')
                                            <a href="{{route('teams.show', $match->match_teams[1]->team->id)}}">
                                                {{$match->match_teams[1]->team->name}}
                                            </a>
                                        @else
                                            {{$match->match_teams[1]->team->name}}
                                        @endif
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
                                        @role('admin')
                                        <div class="col">
                                            @switch($match->match->status_id)
                                                @case(15)
                                                <span class="bg-primary">{{__('Incoming match')}}</span>
                                                @break
                                                @case(16)
                                                <span class="bg-warning">{{__('Waiting for accept')}}</span>
                                                @break
                                                @case(9)
                                                <span class="bg-success">{{__('Accepted')}}</span>
                                                @break
                                                @default
                                                <span class="bg-danger">{{__('Other')}}</span>
                                            @endswitch
                                        </div>
                                        @endrole
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

