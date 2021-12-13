@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('Users awaiting approval by the admin') }}</div>
                    @if($data == null)
                        There are no users
                    @else
                        @foreach($data as $role)
                            @if(!$role == null)
                                @foreach($role as $user)
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('team_users.accept_admin_store') }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group row hidden">
                                                <div class="col-md-6">
                                                    <label for="user_id"></label>
                                                    <input id="user_id" class="" name="user_id" value="{{$user['id']}}">
                                                </div>
                                            </div>
                                            <div class="form-group row-flex">
                                                <label class="col-form-label" for="name">{{__('First name')}}</label>
                                                <input type="text" readonly class="form-control-plaintext" name="name"
                                                       id="name" value="{{$user->name}}">
                                            </div>
                                            <div class="form-group row-flex">
                                                <label class="col-form-label" for="surname">{{__('Surname')}}</label>
                                                <input type="text" readonly class="form-control-plaintext" name="surname"
                                                       id="surname" value="{{$user->surname}}">
                                            </div>
                                            <div class="form-group row">
                                                {{$user->date_birth}}
                                            </div>
                                            <div class="form-group row">
                                                {{$user->email}}
                                            </div>
                                            <div class="form-group row">
                                                <input type="text" readonly class="form-control-plaintext" name="role"
                                                       id="role" value="{{$user->role}}">
                                            </div>
                                            @if(isset($user->team->name))
                                                <div class="form-group row">
                                                    {{$user->team->name}}
                                                </div>
                                            @endif
                                            <div class="form-group row ">
                                                <div class="col-md-6">
                                                    <input type="submit" class="btn btn-primary" name="accept"
                                                           value="{{__('Accept')}}">
                                                    <input type="submit" class="btn btn-primary" name="decline"
                                                           value="{{__('Decline')}}">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
