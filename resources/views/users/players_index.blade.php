@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Your players') }}</div>
                    <div class="card-body">
                        @foreach($users as $user)
                            <div class="row">
                                <span>{{$user->name}} {{$user->surname}}</span>
                                <div class="card-button">
                                    <a href="#">
                                        <button>{{__('Remove player')}}</button>
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

