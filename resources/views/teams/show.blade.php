@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('Show team') }}</div>
                    <div class="card-body">
                        <div class="card-title">{{ __('Team info') }}</div>
                        <div class="row">
                            <div class="col">{{ __('Name') }}</div>
                            <div class="col">{{$team->name}}</div>
                        </div>
                        <div class="row">
                            <div class="col">{{ __('Town') }}</div>
                            <div class="col">{{$team->town}}</div>
                        </div>
                        <div class="row">
                            <div class="col col-flex">
                                <div class="card-button m-0">
                                    <a href="{{route('users.players_index_admin', $team->id)}}">
                                        <button class="btn btn-secondary">{{__('Show players')}}</button>
                                    </a>
                                </div>
                                @if(isset($season))
                                    @role('admin')
                                    <div class="card-button ml-1">
                                        <button class="btn btn-secondary" id="move_button" onclick="showForm()">{{__('Move team')}}</button>
                                    </div>
                                    @endrole
                                @endif
                                <div class="card-button ml-1">
                                    <a href="{{route('teams.index')}}">
                                        <button class="btn btn-secondary">{{__('All teams')}}</button>
                                    </a>
                                </div>
                                @if($teamsSeasons)
                                <div class="card-button ml-1">
                                    <button class="btn btn-secondary" id="history_button" onclick="showHistory()">{{__('Performances history')}}</button>
                                </div>
                                @endif
                            </div>
                        </div>
                        @if(isset($season))
                        <div class="row">
                            <div class="col">
                                <form id="move-form" class="hidden" method="POST" action="{{route('teams.change_team_league', $team->id)}}">
                                    @csrf
                                    <label for="season">{{__('Season')}}</label>
                                    <select id="season" name="season" class="form-select">
                                        <option value="{{$season->id}}">{{$season->name}}</option>
                                    </select>
                                    <label for="league">{{__('League')}}</label>
                                    <select id="league" name="league" class="form-select">
                                        <option value="none">{{__('No league')}}</option>
                                    @foreach($leagues as $league)
                                            <option value="{{$league->id}}" @if($league_season && $league_season->league_id == $league->id) selected @endif>{{$league->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="row">
                                        <input type="submit" class="btn btn-primary" value="{{__('Move')}}">
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endif
                        @if($teamsSeasons)
                            <div class="row hidden" id="history">
                                @foreach($teamsSeasons as $teamsSeason)
                                    <div class="row row-flex bg-info m-1 p-1 d-flex align-items-center">
                                        <div class="col-auto">
                                            <span class="text-body font-weight-bold">{{__($teamsSeason->seasonName)}} -</span>
                                            <span class="text-body font-weight-bold">{{__($teamsSeason->leagueName)}}</span>
                                        </div>
                                        <div class="col-auto">
                                            <a href="{{route('league_seasons.show', $teamsSeason->league_season_id)}}">
                                                <button class="btn btn-secondary">{{__("Timetable")}}</button>
                                            </a>
                                        </div>
                                        <div class="col-auto">
                                            <a href="{{route('league_seasons.show_table', $teamsSeason->league_season_id)}}">
                                                <button class="btn btn-secondary">{{__("Table")}}</button>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="row">
                                <div class="col col-flex">
                                        <span class="text-danger">
                                            {{ __(session('error'))}}
                                        </span>
                                </div>
                            </div>
                        @endif
                        @if(session('success'))
                            <div class="row">
                                <div class="col col-flex">
                                        <span class="text-success">
                                            {{ __(session('success'))}}
                                        </span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function showForm()
    {
        document.getElementById("move_button").style.display = "none"
        document.getElementById("move-form").style.display = "block"
    }
    function showHistory()
    {
        document.getElementById("history_button").style.display = "none"
        document.getElementById("history").style.display = "block"
    }
</script>
