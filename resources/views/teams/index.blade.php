@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('All teams') }}</div>
                    <div class="card-body">
                        @foreach($teams as $team)
                            <div class="row row-flex bg-info m-1 p-1 d-flex align-items-center">
                                <div class="col-auto">
                                    <span class="text-body">{{$loop->iteration}}.</span>
                                    <span class="text-body font-weight-bold">{{$team->name}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="col-flex">
                                        @role('admin')
                                        <div class="card-button">
                                            <a href="{{route('teams.edit', $team->id)}}">
                                                <button class="btn-sm btn-secondary">{{__('Edit team')}}</button>
                                            </a>
                                        </div>
                                        @endrole
                                        <div class="card-button">
                                            <a href="{{route('teams.show', $team->id)}}">
                                                <button class="btn-sm btn-secondary">{{__('Show team')}}</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

