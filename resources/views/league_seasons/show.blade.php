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
                                            {{$match->match_teams[0]->goals}}
                                        -
                                            {{$match->match_teams[1]->goals}}
                                        @if($match->match_teams[1]->team->name != 'PAUSE')
                                            <a href="{{route('teams.show', $match->match_teams[1]->team->id)}}">
                                                {{$match->match_teams[1]->team->name}}
                                            </a>
                                        @else
                                            {{$match->match_teams[1]->team->name}}
                                        @endif
                                    </div>
                                    @if($match->match_teams[0]->team->name != 'PAUSE' && $match->match_teams[1]->team->name != 'PAUSE')
                                        <div class="col col-flex">
                                            @if($match->match->date)
                                                <span class="text-body">
                                                {{$match->match->date}}
                                            </span>
                                            @else
                                                <span class="text-body"></span>
                                            @endif
                                            @role('admin')
                                            @if($match->match->status_id == 15)
                                                <button class="btn-primary date_change" id="button-date_{{$match->match->id}}" onclick="dateForm({{$match->match->id}})">{{__('Change date')}}</button>
                                                <form id="change-date-form_{{$match->match->id}}" class="hidden" method="POST"
                                                      action="{{route("matches.change_date", $match->match->id)}}">
                                                    @csrf
                                                    <label>
                                                        <input name="date" type="date">
                                                    </label>
                                                    <label>
                                                        <input name="league_season_id" type="hidden" value="{{$league_season_id}}">
                                                    </label>
                                                    <input class="btn-primary" type="submit" value="{{__("Change")}}">
                                                </form>
                                            @endif
                                            @endrole
                                        </div>
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
<script>
    function dateForm(id)
    {
        let button = document.getElementById("button-date_" + id)
        let form = document.getElementById("change-date-form_" + id)
        button.style.display = "none"
        form.style.display = "block"
    }
</script>
@endsection
