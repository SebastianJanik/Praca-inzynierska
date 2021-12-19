@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header text-center font-weight-bold">{{ __('Hello')}} {{$data->user->name}}</div>
                    <div class="card-body">
                        <div class="row-flex">
                            <div class="col">
                                <div class="row-flex">
                                    <span class="text-body">{{__('Your actual role is')}}</span>
                                    <span class="text-body font-weight-bold">{{__($data->role->name)}}</span>
                                </div>
                                @if($data->role->name == "coach" || $data->role->name == "player")
                                    <div class="row-flex">
                                        @if($data->team != null)
                                            <span class="text-body">{{__('Your current team is')}}</span>
                                            <span class="text-body font-weight-bold">{{$data->team->name}}</span>
                                        @else
                                            <span class="text-body">{{__("You don't have a team yet")}}</span>
                                        @endif
                                    </div>
                                @endif
                                    <div class="row-flex">
                                        <span class="text-body">{{__("You are with us")}} {{$data->days}} {{__("days")}}</span>
                                    </div>
                            </div>
                            <div class="col">
                                <div class="row-flex">
                                    <span class="text-body">{{$data->user->name}}&nbsp;</span>
                                    <span class="text-body">{{$data->user->surname}}</span>
                                </div>
                                <div class="row-flex">
                                    <span class="text-body">{{$data->user->email}}</span>
                                </div>
                                @if($data->birthday)
                                    <div class="row-flex">
                                        <span class="text-body">{{__("Happy birthday !")}}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header text-center">{{ __('Closest matches')}}</div>
                    <div class="card-body">
                        @if($data->matches)
                            @foreach($data->matches as $match)
                                <div class="row">
                                    <div class="row">
                                        <span class="text-body text-center">{{$match->league->name}}</span>
                                    </div>
                                    <div class="row-flex justify-content-center">
                                    <span class="text-body">
                                        @if($match->teams[0] != null)
                                            {{$match->teams[0]->name}}
                                        @else
                                            {{__('PAUSE')}}
                                        @endif
                                    </span>
                                        <span class="text-body">-</span>
                                        <span class="text-body">
                                        @if(isset($match->teams[1]))
                                                {{$match->teams[1]->name}}
                                            @else
                                                {{__('PAUSE')}}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
@endsection


