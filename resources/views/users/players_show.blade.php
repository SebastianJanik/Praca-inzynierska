@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('Show player') }}</div>
                    <div class="card-body">
                        @if (session('success'))
                        <span class="text-success">
                            {{ __(session('success')) }}
                        </span>
                        @endif
                        <div class="card-title">{{ __('Player info') }}</div>
                        <div class="row">
                            <div class="col">{{ __('Player name') }}</div>
                            <div class="col">{{$user->name}}</div>
                        </div>
                        <div class="row">
                            <div class="col">{{ __('Player surname') }}</div>
                            <div class="col">{{$user->surname}}</div>
                        </div>
                        <div class="row">
                            <div class="col">{{ __('Birth date') }}</div>
                            <div class="col">{{$user->date_birth}}</div>
                        </div>
                            <div class="row">
                                <div class="col">{{ __('Roles') }}</div>
                                <div class="col">@foreach($roles as $role){{__($role)}} @endforeach</div>
                            </div>
                        <div class="row align-items-center d-flex">
                            <div class="col">{{ __('Status') }}</div>
                            <div class="col">
                                <span class="text-body">{{__($status->message)}}</span>
                                @if($status->id == 4)
                                    <a href="{{route('suspensions.edit', $suspension->id)}}">
                                        <button class="btn btn-warning ml-1">{{__('Edit suspension')}}</button>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <td colspan="3" class="text-center">{{__('Stats')}}</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td></td>
                                <td>{{__('All seasons')}}</td>
                                <td>{{__('This season')}}</td>
                            </tr>
                            <tr>
                                <td>{{__('Goals')}}</td>
                                <td>{{$all_goals}}</td>
                                <td>{{$goals}}</td>
                            </tr>
                            <tr>
                                <td>{{__('Assists')}}</td>
                                <td>{{$all_assists}}</td>
                                <td>{{$assists}}</td>
                            </tr>
                            <tr>
                                <td>{{__('Minutes played')}}</td>
                                <td>{{$all_minutes}}</td>
                                <td>{{$minutes}}</td>

                            </tr>
                            <tr>
                                <td>{{__('Yellow cards')}}</td>
                                <td>{{$all_yellows}}</td>
                                <td>{{$yellows}}</td>

                            </tr>
                            <tr>
                                <td>{{__('Red cards')}}</td>
                                <td>{{$all_reds}}</td>
                                <td>{{$reds}}</td>

                            </tr>
                            </tbody>
                        </table>
                        <div class="row">
                            @if($canRemove)
                            <div class="card-button col-auto">
                                <form class="remove" method="POST" action="{{route('team_users.remove', $user->id)}}" >
                                    @csrf
                                    <div class="card-button">
                                        <button class="btn btn-danger">{{__('Remove')}}</button>
                                    </div>
                                </form>
                            </div>
                            @role('admin')
                            <div class="card-button col-auto">
                                <form class="suspend" method="POST" action="{{route('suspensions.create')}}">
                                @csrf
                                    <input name="user_id" class="hidden" value="{{$user->id}}">
                                    <button class="btn btn-warning">{{__('Suspend')}}</button>
                                </form>
                            </div>
                            @endrole
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
