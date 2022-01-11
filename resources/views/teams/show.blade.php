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
                                    <div class="card-button">
                                        <button class="btn btn-secondary" id="move-button" onclick="showForm()">{{__('Move team')}}</button>
                                    </div>
                                @endif
                            </div>
                        </div>
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
        document.getElementById("move-button").style.display = "none"
        document.getElementById("move-form").style.display = "block"
    }
</script>
