@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('Create suspension') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('suspensions.store') }}">
                            @csrf
                            @foreach($users as $user)
                            <input class="hidden" name="user_id[]" value="{{$user->id}}">
                            <div class="row">
                                <div class="col">{{ __('Player name') }}</div>
                                <div class="col">{{$user->name}}</div>
                            </div>
                            <div class="row">
                                <div class="col">{{ __('Player surname') }}</div>
                                <div class="col">{{$user->surname}}</div>
                            </div>
                            <div class="row">
                                <div class="col">{{ __('Lenght') }}</div>
                                <div class="col"><input type="number" name="length[{{$user->id}}]" min="0" required></div>
                            </div>
                            <div class="row">
                                <div class="col">{{ __('Reason') }}</div>
                                <div class="col"><textarea class="form-control" name="reason[{{$user->id}}]" required></textarea></div>
                            </div>
                            @endforeach
                            <div class="row">
                                <div class="col"><button class="btn-warning">{{__('Suspend')}}</button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
