@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('Become a referee') }}</div>
                    <div class="card-body">
                        @if(!isset($error))
                            <div class="row text-center">
                                <span class="text-body">
                                    {{__('Are you sure, you want to become a referee ?')}}
                                </span>
                            </div>
                            <div class="row text-center">
                                    <form method="POST" action="{{ route('users.referee_store') }}">
                                        @csrf
                                        <input type="submit" class="btn btn-success" value="{{__('Yes')}}">
                                        <a href="{{route('home')}}">
                                            <button type="button" class="btn btn-danger">{{__('No')}}</button>
                                        </a>
                                    </form>
                            </div>
                            @else
                            <div class="row">
                                <span class="text-danger">{{__($error)}}</span>
                            </div>
                            <div class="row">
                                <a href="{{route('home')}}">
                                    <button type="button" class="btn btn-secondary">{{__('Home')}}</button>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
