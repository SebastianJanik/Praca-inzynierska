@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header text-center font-weight-bold">{{ __('Hello')}} {{$data->user->name}}</div>
                    <div class="card-body">
                        <div class="row-flex">
                            <span class="text-body">
                                {{__('Your actual role is')}}
                            </span>
                            <span class="text-body font-weight-bold">
                                {{__($data->role->name)}}
                            </span>
                        </div>
                        @if($data->role->name == "coach" || $data->role->name == "player")
                        <div class="row-flex">
                            @if($data->team != null)
                            <span class="text-body">
                                {{__('Your current team is')}}
                            </span>
                            <span class="text-body font-weight-bold">
                                {{__($data->team->name)}}
                            </span>
                            @else
                                <span class="text-body">
                                    {{__("You don't have a team yet")}}
                                </span>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


