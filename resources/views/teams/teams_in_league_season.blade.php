@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <span class="text-body">{{ __('All teams')}}</span>
                        <span class="text-body">{{$season->name}}</span>
                        <span class="text-body"> {{$league->name}}</span></div>
                    <div class="card-body">
                        @if(isset($message))
                            <span class="text-body">{{__($message)}}</span>
                        @elseif($teams)
                        @foreach($teams as $team)
                            <div class="row-flex">
                                <span class="text-body">{{$loop->iteration}}.</span>
                                <span class="text-body">{{__($team->name)}}</span>
                                <div class="card-button">
                                    <a href="{{route('teams.show', $team->id)}}">
                                        <button>{{__('Show team')}}</button>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

