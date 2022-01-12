@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('Users awaiting approval by the admin') }}</div>
                    @if (session('warning'))
                    <span class="text-info">
                        {{ __(session('warning')) }}
                    </span>
                    @endif
                    @if (session('success'))
                    <span class="text-success">
                        {{ __(session('success')) }}
                    </span>
                    @endif
                    @if($data == null)
                    <span class="text-danger">
                    {{ __('There are no users') }}
                    <span>
                    @else
                        @foreach($data as $role)
                            @if(!$role == null)
                                @foreach($role as $user)
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('team_users.accept_admin_store') }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group row hidden">
                                                <input type="text" class="hidden" name="user_id" id="user_id" value="{{$user['id']}}">
                                                <input type="text" class="hidden" name="name" id="name" value="{{$user->name}}">
                                                <input type="text" class="hidden" name="surname" id="surname" value="{{$user->surname}}">
                                            </div>
                                            <div class="form-group row-flex">
                                                <span class="text-body col-md-2">{{__('First name')}}</span>
                                                <span class="text-body font-weight-bold">{{$user->name}}</span>
                                            </div>
                                            <div class="form-group row-flex">
                                                <span class="text-body col-md-2">{{__('Surname')}}</span>
                                                <span class="text-body font-weight-bold">{{$user->surname}}</span>
                                            </div>
                                            <div class="form-group row-flex">
                                                <span class="text-body col-md-2">{{__('Date of birth')}}</span>
                                                <span class="text-body font-weight-bold">{{$user->date_birth}}</span>
                                            </div>
                                            <div class="form-group row-flex">
                                                <span class="text-body col-md-2">{{__('E-mail')}}</span>
                                                <span class="text-body font-weight-bold">{{$user->email}}<span>
                                            </div>
                                            <div class="form-group row-flex">
                                                <span class="text-body col-md-2">{{__('Role')}}</span>
                                                <span class="text-body font-weight-bold">{{__($user->role)}}</span>
												<input class="hidden" name="role" id="role" value="{{$user->role}}">
                                            </div>
                                            @if(isset($user->team->name))
                                                <div class="form-group row-flex">
                                                    <span class="text-body col-md-2">{{__('Team')}}</span>
                                                    <span class="text-body font-weight-bold">{{$user->team->name}}</span>
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
