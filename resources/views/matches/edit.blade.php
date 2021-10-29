@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
                <div class="card">
                    <div class="card-header">{{ __('Edit match') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('matches.update', $match->id) }}">
                            @csrf
                            @method('PATCH')
                            <div class="row justify-content-center">Match Result</div>
                            <div class="row">
                                <div class="col float-left">
                                    {{$teams[0]->name}}
                                    <input type="number" min="0" name="goals_team[{{$teams[0]->id}}]" @if($match_teams[0]->goals) value = "{{$match_teams[0]->goals}}" @else value="0" @endif>
                                </div>
                                <div class="col float-right">
                                    <input type="number" min="0" name="goals_team[{{$teams[1]->id}}]" @if($match_teams[1]->goals) value = "{{$match_teams[1]->goals}}" @else value="0" @endif>
                                    {{$teams[1]->name}}
                                </div>
                            </div>
                            <div class="row">
                                @foreach($teams as $team)
                                    <div class="col-xl">
                                        <table class="table">
                                            <thead class="thead-dark">
                                            <tr>
                                                <td>{{$team->name}}</td>
                                                <td>Start</td>
                                                <td>End</td>
                                                <td>Goals</td>
                                                <td>Assists</td>
                                                <td>Yellow Cards</td>
                                                <td>Red cards</td>
                                                <td>Enable</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($team_users as $team_user)
                                                @if($team_user->team_id == $team->id)
                                                    @foreach($users as $user)
                                                        @if($user->id == $team_user->user_id)
                                                                @php ($founded = false)
                                                                @foreach($match_users as $match_user)
                                                                    @if($match_user->user_id == $user->id)
                                                                        <tr class="col_user_{{$user->id}}" style="background-color: #5cd08d">
                                                                        <td>
                                                                            <input class="input_user_{{$user->id}}" type="hidden" name="user_id[]" value="{{$user->id}}">
                                                                            <input readonly value="{{$user->name}} {{$user->surname}}" disabled>
                                                                        </td>
                                                                        <td><input class="input_user_{{$user->id}}" type="number" max="90" min="0" name="start[{{$user->id}}]" value="{{$match_user->start_min}}" ></td>
                                                                        <td><input class="input_user_{{$user->id}}" type="number" max="90" min="0" name="end[{{$user->id}}]" value="{{$match_user->end_min}}" ></td>
                                                                        <td><input class="input_user_{{$user->id}}" type="number" min="0" name="goals[{{$user->id}}]" value="{{$match_user->goals}}" ></td>
                                                                        <td><input class="input_user_{{$user->id}}" type="number" min="0" name="assists[{{$user->id}}]" value="{{$match_user->assists}}" ></td>
                                                                        <td><input class="input_user_{{$user->id}}" type="number" max="2" min="0" name="yellow[{{$user->id}}]" value="{{$match_user->yellow_card}}" ></td>
                                                                        <td><input class="input_user_{{$user->id}}" type="number" max="1" min="0" name="red[{{$user->id}}]" value="{{$match_user->red_card}}" ></td>
                                                                        <td><input type="checkbox" class="checkbox_user_{{$user->id}}" onchange="Enable({{$user->id}})" checked></td>
                                                                        @php ($founded = true)
                                                                    @endif
                                                                @endforeach
                                                                @if(!$founded)
                                                                    <tr class="col_user_{{$user->id}}" style="background-color: red">
                                                                    <td>
                                                                        <input class="input_user_{{$user->id}}" type="hidden" name="user_id[]" value="{{$user->id}}" disabled>
                                                                        <input readonly value="{{$user->name}} {{$user->surname}}" disabled>
                                                                    </td>
                                                                    <td><input class="input_user_{{$user->id}}" type="number" max="90" min="0" name="start[{{$user->id}}]" value="0" disabled></td>
                                                                    <td><input class="input_user_{{$user->id}}" type="number" max="90" min="0" name="end[{{$user->id}}]" value="0" disabled></td>
                                                                    <td><input class="input_user_{{$user->id}}" type="number" min="0" name="goals[{{$user->id}}]" value="0" disabled></td>
                                                                    <td><input class="input_user_{{$user->id}}" type="number" min="0" name="assists[{{$user->id}}]" value="0" disabled></td>
                                                                    <td><input class="input_user_{{$user->id}}" type="number" max="2" min="0" name="yellow[{{$user->id}}]" value="0" disabled></td>
                                                                    <td><input class="input_user_{{$user->id}}" type="number" max="1" min="0" name="red[{{$user->id}}]" value="0" disabled></td>
                                                                    <td><input type="checkbox" class="checkbox_user_{{$user->id}}" onchange="Enable({{$user->id}})"></td>
                                                                    </tr>
                                                                @endif
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update match') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
    </div>
@endsection

<script>
    function Enable(userId) {
        let inputs = document.getElementsByClassName('input_user_' + userId)
        Array.prototype.forEach.call(inputs, (input) => {
            if(!input.disabled)
                document.getElementsByClassName('col_user_' + userId)[0].style.backgroundColor = "RED"
            if(input.disabled)
                document.getElementsByClassName('col_user_' + userId)[0].style.backgroundColor = "YELLOW"
            input.disabled = !input.disabled
        })
    }
</script>