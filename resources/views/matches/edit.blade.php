@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('Edit match') }}</div>
                    <div class="card-body">
                        @if(isset($error))
                            <div class="row text-center">
                                <span class="text-danger">{{ __($error) }}</span>
                            </div>
                        @else
                            @if(session('error'))
                                <div class="row text-center">
                                    <span class="text-danger">{{ __(session('error')) }}</span>
                                </div>
                            @endif
                        <form method="POST" action="{{ route('matches.update', $match->id) }}">
                            @csrf
                            @method('PATCH')
                            <div class="row justify-content-center">{{ __('Match Result') }}</div>
                            <div class="row-flex">
                                <div class="col-flex">
                                    <div class="col">
                                    {{$teams[0]->name}}
                                    </div>
                                    <div class="col">
                                    <input type="number" min="0" name="goals_team[{{$teams[0]->id}}]"
                                        @if($match_teams[0]->goals) value="{{$match_teams[0]->goals}}"
                                        @else value="0" @endif>
                                    </div>
                                </div>
                                <div class="col-flex">
                                    <div class="col">
                                    <input type="number" min="0" name="goals_team[{{$teams[1]->id}}]"
                                        @if($match_teams[1]->goals) value="{{$match_teams[1]->goals}}"
                                        @else value="0" @endif>
                                    </div>
                                    <div class="col text-right">
                                    {{$teams[1]->name}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @foreach($teams as $team)
                                    <div class="row">
                                        <table class="table">
                                            <thead class="thead-dark">
                                            <tr>
                                                <td>{{$team->name}}</td>
                                                <td>{{ __('Start') }}</td>
                                                <td>{{ __('End') }}</td>
                                                <td>{{ __('Goals') }}</td>
                                                <td>{{ __('Assists') }}</td>
                                                <td>{{ __('Yellow cards') }}</td>
                                                <td>{{ __('Red cards') }}</td>
                                                <td>{{ __('Enable') }}</td>
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
                                                                    <tr class="col_user_{{$user->id}}"
                                                                        style="background-color: #5cd08d">
                                                                        <td>
                                                                            <input class="input_user_{{$user->id}}"
                                                                                type="hidden" name="user_id[]"
                                                                                value="{{$user->id}}">
                                                                            <a href="{{route ('users.players_show', $user->id)}}">
                                                                                <input readonly
                                                                                value="{{$user->name}} {{$user->surname}}"
                                                                                disabled></a>
                                                                        </td>
                                                                        <td><input class="input_user_{{$user->id}}"
                                                                                type="number" max="90" min="0"
                                                                                name="start[{{$user->id}}]"
                                                                                value="{{$match_user->start_min}}"></td>
                                                                        <td><input class="input_user_{{$user->id}}"
                                                                                type="number" max="90" min="0"
                                                                                name="end[{{$user->id}}]"
                                                                                value="{{$match_user->end_min}}"></td>
                                                                        <td><input class="input_user_{{$user->id}}"
                                                                                type="number" min="0"
                                                                                name="goals[{{$user->id}}]"
                                                                                value="{{$match_user->goals}}"></td>
                                                                        <td><input class="input_user_{{$user->id}}"
                                                                                type="number" min="0"
                                                                                name="assists[{{$user->id}}]"
                                                                                value="{{$match_user->assists}}"></td>
                                                                        <td><input class="input_user_{{$user->id}}"
                                                                                type="number" max="2" min="0"
                                                                                name="yellow[{{$user->id}}]"
                                                                                value="{{$match_user->yellow_card}}">
                                                                        </td>
                                                                        <td><input class="input_user_{{$user->id}}"
                                                                                type="number" max="1" min="0"
                                                                                name="red[{{$user->id}}]"
                                                                                value="{{$match_user->red_card}}"></td>
                                                                        <td><input type="checkbox"
                                                                                class="checkbox_user_{{$user->id}}"
                                                                                onchange="Enable({{$user->id}})" checked>
                                                                        </td>
                                                                    @php ($founded = true)
                                                                @endif
                                                            @endforeach
                                                            @if(!$founded)
                                                                <tr class="col_user_{{$user->id}}"
                                                                    style="background-color: red">
                                                                    <td>
                                                                        <input class="input_user_{{$user->id}}"
                                                                            type="hidden" name="user_id[]"
                                                                            value="{{$user->id}}" disabled>
                                                                        <a href="{{route ('users.players_show', $user->id)}}">
                                                                            <input readonly
                                                                                value="{{$user->name}} {{$user->surname}}"
                                                                                disabled></a>
                                                                    </td>
                                                                    <td><input class="input_user_{{$user->id}}"
                                                                            type="number" max="90" min="0"
                                                                            name="start[{{$user->id}}]" value="0"
                                                                            disabled></td>
                                                                    <td><input class="input_user_{{$user->id}}"
                                                                            type="number" max="90" min="0"
                                                                            name="end[{{$user->id}}]" value="0" disabled>
                                                                    </td>
                                                                    <td><input class="input_user_{{$user->id}}"
                                                                            type="number" min="0"
                                                                            name="goals[{{$user->id}}]" value="0"
                                                                            disabled></td>
                                                                    <td><input class="input_user_{{$user->id}}"
                                                                            type="number" min="0"
                                                                            name="assists[{{$user->id}}]" value="0"
                                                                            disabled></td>
                                                                    <td><input class="input_user_{{$user->id}}"
                                                                            type="number" max="2" min="0"
                                                                            name="yellow[{{$user->id}}]" value="0"
                                                                            disabled></td>
                                                                    <td><input class="input_user_{{$user->id}}"
                                                                            type="number" max="1" min="0"
                                                                            name="red[{{$user->id}}]" value="0" disabled>
                                                                    </td>
                                                                    <td><input type="checkbox"
                                                                            class="checkbox_user_{{$user->id}}"
                                                                            onchange="Enable({{$user->id}})"></td>
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
                            @if($match->status_id != 9)
                            <div class="row">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update match') }}
                                </button>
                            </div>
                            @endif
                        </form>
                        @role('admin')
                        @if($match->status_id != 15)
                            @if($match->status_id != 9)
                                <form method="POST" action="{{ route('matches.protocol', $match->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <div class="row">
                                        <input class="hidden" name="accept" value="accept">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Accept protocol') }}
                                        </button>
                                    </div>
                                </form>
                            @else
                                <form method="POST" action="{{ route('matches.protocol', $match->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <div class="row">
                                        <input class="hidden" name="restore" value="restore">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Restore editable') }}
                                        </button>
                                    </div>
                                </form>
                            @endif
                        @endif
                        @endrole
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function Enable(userId) {
        let inputs = document.getElementsByClassName('input_user_' + userId)
        Array.prototype.forEach.call(inputs, (input) => {
            if (!input.disabled)
                document.getElementsByClassName('col_user_' + userId)[0].style.backgroundColor = "RED"
            if (input.disabled)
                document.getElementsByClassName('col_user_' + userId)[0].style.backgroundColor = "YELLOW"
            input.disabled = !input.disabled
        })
    }
</script>
<style>
    table{
        table-layout: fixed;
    }
    td, th{
        word-wrap: break-word;
    }
    input {
        width: 100%;
    }
</style>
