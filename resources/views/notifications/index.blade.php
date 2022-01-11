@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">{{__('All notifications')}}</div>
            @foreach($notifications as $notification)
            <div class="card-body @if($notification->status=='active') bg-info font-weight-bold @endif m-1">
                <div class="row row-flex d-flex align-items-center">
                    <div class="col-auto">
                        <span class="text-body">{{__($notification->title)}}</span>
                    </div>
                    <div class="card-button col-auto">
                        <a href="{{route('notifications.show', $notification->id)}}">
                            <button class="btn btn-secondary">{{__('Show')}}</button>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
