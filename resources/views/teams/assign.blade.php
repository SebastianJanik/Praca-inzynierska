@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Assign team') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('teams_updateAssign', $team->id) }}">
                            @csrf
                            @method('PATCH')
                            <div class="form-group row">
                                <label for="league"
                                       class="col-md-4 col-form-label text-md-right">{{ __('League') }}</label>

                                <div class="col-md-6">
                                    <select id="league" type="text"
                                            class="form-control @error('league') is-invalid @enderror" name="league_id"
                                            required autocomplete="league" autofocus>
                                        <option value="" disabled selected>{{__('Select league')}}</option>
                                        <option value="none">{{__('None league')}}</option>
                                        @foreach($leagues as $league)
                                            <option value="{{$league->id}}">{{$league->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('league')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="season"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Season') }}</label>

                                <div class="col-md-6">
                                    <select id="season" type="text"
                                            class="form-control @error('season') is-invalid @enderror" name="season_id"
                                            required autocomplete="season" autofocus>
                                        <option value="" disabled selected>{{__('Select season')}}</option>
                                        @foreach($seasons as $season)
                                            <option value="{{$season->id}}">{{$season->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('season')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Assign team') }}
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

