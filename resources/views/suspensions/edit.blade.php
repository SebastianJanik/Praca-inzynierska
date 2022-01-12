@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <form method="POST" action="{{ route('suspensions.update') }}">
                        @csrf
                        @method('PATCH')
                        <div class="card-header">{{ __($title) }}</div>
                        <div class="card-body">
                            @if (session('success'))
                            <span class="text-success">
                                {{ __(session('success')) }}
                            </span>
                            @endif
                            @if(isset($match_id))
                                <input class="hidden" name="match_id" value="{{$match_id}}">
                            @endif
                            @if($data != null)
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
                                            <div class="col">{{ __('Suspension status') }}</div>
                                            @if($item->suspension->status_id == 1)
                                                <div class="col">{{__('Active')}}</div>
                                            @else
                                                <div class="col">{{__('Inactive')}}</div>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="col">{{ __('Lenght') }}</div>
                                            <div class="col"><input type="number"
                                                                    name="length[{{$item->suspension->id}}]"
                                                                    min="0" value="{{$item->suspension->length}}"
                                                                    required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">{{ __('Matches left') }}</div>
                                            <div class="col"><input type="number"
                                                                    name="matches_left[{{$item->suspension->id}}]"
                                                                    min="0"
                                                                    value="{{$item->suspension->matches_left}}"
                                                                    required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">{{ __('Reason') }}</div>
                                            <div class="col"><textarea class="form-control"
                                                                       name="reason[{{$item->suspension->id}}]"
                                                                       required>{{$item->suspension->reason}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                            @if(isset($dataEnd) && $dataEnd != null)
                                <div class="card-header">{{ __($secondtitle) }}</div>
                                <div class="card-body">
                                    @foreach($dataEnd as $item)
                                        <div class="row">
                                            <input class="hidden" name="user_id[]" value="{{$item->user->id}}">
                                            <input class="hidden" name="suspension_id[]"
                                                   value="{{$item->suspension->id}}">
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
                                                <div class="col">{{ __('Suspension status') }}</div>
                                                @if($item->suspension->status_id == 1)
                                                    <div class="col">{{__('Active')}}</div>
                                                @else
                                                    <div class="col">{{__('Inactive')}}</div>
                                                @endif
                                            </div>
                                            <div class="row">
                                                <div class="col">{{ __('Length') }}</div>
                                                <div class="col"><input type="number"
                                                                        name="length[{{$item->suspension->id}}]"
                                                                        min="0" value="{{$item->suspension->length}}"
                                                                        required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">{{ __('Matches left') }}</div>
                                                <div class="col"><input type="number"
                                                                        name="matches_left[{{$item->suspension->id}}]"
                                                                        min="0"
                                                                        value="{{$item->suspension->matches_left}}"
                                                                        required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">{{ __('Reason') }}</div>
                                                <div class="col"><textarea class="form-control"
                                                                           name="reason[{{$item->suspension->id}}]"
                                                                           required>{{$item->suspension->reason}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-auto card-button">
                                    @if(!isset($match_id))
                                        <button class="btn btn-warning">{{__('Suspend')}}</button>
                                    @else
                                        <button class="btn btn-warning">{{__('Update')}}</button>
                                    @endif
                                </div>
                                @if(!isset($match_id))
                                    <div class="col-auto card-button">
                                        <a href="{{route('users.players_show', $data[0]->user->id)}}">
                                            <button type="button" class="btn btn-secondary">{{__('Back')}}</button>
                                        </a>
                                    </div>
                                @endif
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
