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
                            <div class="card-button">
                                <a href="{{route('users.players_index_admin', $team->id)}}">
                                    <button>{{__('Show players')}}</button>
                                </a>
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col">{{ __('Status') }}</div>
                            <div class="col">{{$status->name}}</div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
