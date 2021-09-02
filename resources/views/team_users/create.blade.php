@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add user to team') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('team_users_store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="user" class="col-md-4 col-form-label text-md-right">{{ __('User') }}</label>
                                <div class="col-md-6">
                                    <input id="user" type="text"
                                           class="form-control @error('user') is-invalid @enderror" name="user"
                                           value="{{ old('user') }}" required autocomplete="user" list="users"
                                           autofocus>
                                    <datalist id="users">
                                        @foreach($players as $player)
                                            <option value="{{$player->email}}"></option>
                                        @endforeach
                                    </datalist>
                                    @error('user')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="user" class="col-md-4 col-form-label text-md-right">{{ __('Team') }}</label>
                                <div class="col-md-6">
                                    <input id="team" type="text"
                                           class="form-control @error('team') is-invalid @enderror" name="team"
                                           value="{{ old('team') }}" required autocomplete="team" list="teams"
                                           autofocus>
                                    <datalist id="teams">
                                        @foreach($teams as $team)
                                            <option value="{{$team->name}}"></option>
                                        @endforeach
                                    </datalist>
                                    @error('user')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Add user') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
