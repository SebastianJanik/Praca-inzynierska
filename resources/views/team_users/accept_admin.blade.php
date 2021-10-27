@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('Users awaiting approval by the admin') }}</div>
                    @foreach($data as $role)
                    @if(!$role == null)
                        @foreach($role as $user)
                            <div class="card-body">
                                <form method="POST" action="{{ route('team_users.accept_admin_store') }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="row-cols">
                                        <div class="hidden">
                                            <input class="" name="user_id" value="{{$user['id']}}">
                                        </div>
                                        <div class="col">
                                            {{$user->name}}
                                        </div>
                                        <div class="col">
                                            {{$user->surname}}
                                        </div>
                                        <div class="col">
                                            {{$user->date_birth}}
                                        </div>
                                        <div class="col">
                                            {{$user->email}}
                                        </div>
                                        <div class="col">
                                            {{$user->role}}
                                        </div>
                                        @if(isset($user->team->name))
                                        <div class="col">
                                            {{$user->team->name}}
                                        </div>
                                        @endif
                                        <div class="col">
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
                </div>
            </div>
        </div>
    </div>
@endsection
