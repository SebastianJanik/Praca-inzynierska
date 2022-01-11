@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('All seasons') }}</div>

                    <div class="card-body">
                        @foreach($seasons as $season)
                            <div class="row row-flex bg-info m-1">
                                <div class="col col-auto align-items-center d-flex">
                                    <span class="text-body col-auto">{{$loop->iteration}}.</span>
                                    <span class="text-body col-auto">
                                        <a href="{{route('seasons.show', $season->id)}}">
                                            <button class="btn btn-secondary">{{$season->name}}</button>
                                        </a>
                                    </span>
                                    <span class="text-body col-auto text-danger font-weight-bold">{{__($season->status->message)}}</span>
                                </div>
                                <div class="col col-auto">
                                    @role('admin')
                                    <form class="flex-display" method="POST" action="{{route('seasons.change_status')}}">
                                        @csrf
                                        <input type="hidden" value="{{$season->id}}" name="season_id">
                                        @if($season->status->name != 'active')
                                            <div class="card-button">
                                                <button type="submit" name="submit" class="btn btn-success m-1" value="active">{{__('Set active')}}</button>
                                            </div>
                                        @endif
                                        @if($season->status->name != 'inactive')
                                            <div class="card-button">
                                                <button type="submit" name="submit" class="btn btn-warning m-1" value="inactive">{{__('Set inactive')}}</button>
                                            </div>
                                        @endif
                                        @if($season->status->name != 'incoming')
                                            <div class="card-button">
                                                <button type="submit" name="submit" class="btn btn-primary m-1" value="incoming">{{__('Set incoming')}}</button>
                                            </div>
                                        @endif
                                    </form>
                                    @endrole
                                </div>
                            </div>
                        @endforeach
                        <div class="row-flex">
                            <span class="text-danger">
                                @if(session('message'))
                                    {{__(session('message'))}}
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
