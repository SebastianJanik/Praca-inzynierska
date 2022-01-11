@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('Become a referee') }}</div>
                    @if(!isset($error))
                    <span class="text-body">
                        {{__('Are you sure, you want to become a referee ?')}}
                    </span>
                        <form method="POST" action="{{ route('users.referee_store') }}">
                            @csrf
                            <input type="submit" class="btn-success" value="{{__('Yes')}}">
                            <a href="{{route('home')}}">
                                <button type="button" class="btn-danger">{{__('No')}}</button>
                            </a>
                        </form>
                    @else
                    <span class="text-danger">
                        {{__($error)}}
                    </span>
                        <a href="{{route('home')}}">
                            <button type="button" class="btn-primary">{{__('Home')}}</button>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
