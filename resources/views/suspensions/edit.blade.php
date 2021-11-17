@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __($title) }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('suspensions.update') }}">
                            @csrf
                            @method('PATCH')
                            @foreach($data as $item)
                                <div class="row">
                                    <input class="hidden" name="user_id[]" value="{{$item->user->id}}">
                                    <input class="hidden" name="suspension_id[]" value="{{$item->suspension->id}}">
                                    <div class="row">
                                        <div class="col">{{ __('Player name') }}</div>
                                        <div class="col">{{$item->user->name}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col">{{ __('Player surname') }}</div>
                                        <div class="col">{{$item->user->surname}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col">{{ __('Team') }}</div>
                                        <div class="col">{{$item->team->name}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col">{{ __('Lenght') }}</div>
                                        <div class="col"><input type="number" name="length[{{$item->user->id}}]" min="0" value="{{$item->suspension->length}}" required></div>
                                    </div>
                                    <div class="row">
                                        <div class="col">{{ __('Matches left') }}</div>
                                        <div class="col"><input type="number" name="matches_left[{{$item->user->id}}]" min="0" value="{{$item->suspension->matches_left}}" required></div>
                                    </div>
                                    <div class="row">
                                        <div class="col">{{ __('Reason') }}</div>
                                        <div class="col"><textarea class="form-control" name="reason[{{$item->user->id}}]" required>{{$item->suspension->reason}}</textarea></div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="row">
                                <div class="col">
                                    <button class="btn-warning">{{__('Suspend')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
