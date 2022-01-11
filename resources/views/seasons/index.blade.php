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
                                    @role('admin')
                                    <form method="POST" action="{{route('seasons.change_status')}}">
                                        @csrf
                                        <input type="hidden" value="{{$season->id}}" name="season_id">
                                        @if($season->status->name != 'active')
                                            <button type="submit" name="submit" class="btn-success"
                                                    value="active">{{__('Set active')}}</button>
                                        @endif
                                        @if($season->status->name != 'inactive')
                                            <button type="submit" name="submit" class="btn-warning"
                                                    value="inactive">{{__('Set inactive')}}</button>
                                        @endif
                                        @if($season->status->name != 'incoming')
                                            <button type="submit" name="submit" class="btn-primary"
                                                    value="incoming">{{__('Set incoming')}}</button>
                                        @endif
                                    </form>
                                    @endrole
                                </span>
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
