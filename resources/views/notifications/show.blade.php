@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">{{__('Notification')}}</div>
            <div class="card-body">
                <div class="row">
                    <span class="text-body font-weight-bold">{{__($notification->title)}}</span>
                </div>
                <div class="row">
                    <span class="text-body">{{__($notification->description)}}</span>
                </div>
                <div class="row card-button">
                    <a href="{{route('notifications.index')}}">
                        <button class="btn btn-secondary">{{__('Back')}}</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
