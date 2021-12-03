@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('All seasons') }}</div>

                    <div class="card-body">
                        @foreach($seasons as $season)
                            <div class="row-flex">
                                <span class="text-body">{{$loop->iteration}}.</span>
                                <span class="text-body">
                            <a href="{{route('seasons.show', $season->id)}}">{{$season->name}}</a>
                                </span>
                                <span class="text-body">
                                {{__($season->status->message)}}
                            </span>
                                <span class="text-body">
                                <form method="POST" action="{{route('seasons.change_status')}}">
                                    @csrf
                                    <input type="hidden" value="{{$season->id}}" name="season_id">
                                    <input type="submit" class="btn-primary" value="{{__('Change status')}}">
                                </form>
                            </span>
                            </div>
                        @endforeach
                        <div class="row-flex">
                            <span class="text-danger">
                                @if(session('message'))
                                    {{session('message')}}
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
