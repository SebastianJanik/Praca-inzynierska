@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
                <div class="card">
                    <div class="card-header">{{ __('Edit match') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('matches_update', $match->id) }}">
                            @csrf
                            @method('PATCH')
                            <div class="row justify-content-center">Match Result</div>
                            <div class="row">
                                <div class="col float-left">
                                    {{$teams[0]->name}}
                                    <input type="number" min="0" name="goals_team[{{$teams[0]->id}}]" value="0">
                                </div>
                                <div class="col float-right">
                                    <input type="number" min="0" name="goals_team[{{$teams[1]->id}}]" value="0">
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
                                                            <tr class="col_user_{{$user->id}}">
                                                                <td>
                                                                    <input class="input_user_{{$user->id}}" type="hidden" name="user_id[]" value="{{$user->id}}" disabled>
                                                                    <input readonly value="{{$user->name}} {{$user->surname}}" disabled>
                                                                </td>
                                                                <td><input class="input_user_{{$user->id}}" type="number" max="90" min="0" name="start[{{$user->id}}]" value="0" disabled></td>
                                                                <td><input class="input_user_{{$user->id}}" type="number" max="90" min="0" name="end[{{$user->id}}]" value="0" disabled></td>
                                                                <td><input class="input_user_{{$user->id}}" type="number" min="0" name="goals[{{$user->id}}]" value="0" disabled></td>
                                                                <td><input class="input_user_{{$user->id}}" type="number" max="2" min="0" name="yellow[{{$user->id}}]" value="0" disabled></td>
                                                                <td><input class="input_user_{{$user->id}}" type="number" max="1" min="0" name="red[{{$user->id}}]" value="0" disabled></td>
                                                                <td><input type="checkbox" class="checkbox_user_{{$user->id}}" onchange="Enable({{$user->id}})"></td>
                                                            </tr>
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
            input.disabled = !input.disabled
            console.log(input.value)
        })
    }
</script>
