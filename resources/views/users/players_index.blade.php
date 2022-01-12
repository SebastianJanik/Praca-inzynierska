@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('Players') }}</div>
                    <div class="card-body">
                        @if (session('success'))
                            <span class="text-success">
                                {{ __(session('success')) }}
                            </span>
                        @endif
                        @foreach($users as $user)
                            <div class="row row-flex bg-info align-items-center d-flex m-1 p-1">
                                <div class="col-auto">
                                    <span class="text-body">{{$user->name}} {{$user->surname}}</span>
                                </div>
                                <div class="card-button col-auto" id="view_player_button">
                                    <a href="{{route('users.players_show', $user->id)}}">
                                        <button class="btn btn-secondary">{{__('View player')}}</button>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

