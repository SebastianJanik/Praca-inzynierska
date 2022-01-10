@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">{{__('All notifications')}}</div>
            @foreach($notifications as $notification)
            <div class="card-body">
                <div class="row row-flex">
                    <div class="font-weight-bold">
                        {{$notification->title}}
                    </div>
                    <div class="">
                        Button do podgladu powiadomienia
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
