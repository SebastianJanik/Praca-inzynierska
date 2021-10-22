@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit team') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('teams.update', $team->id) }}">
                            @csrf
                            @method('PATCH')
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ $team->name }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="street"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Street') }}</label>

                                <div class="col-md-6">
                                    <input id="street" type="text"
                                           class="form-control @error('street') is-invalid @enderror" name="street"
                                           value="{{ $team->street }}" required autocomplete="street" autofocus>

                                    @error('street')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="house_number"
                                       class="col-md-4 col-form-label text-md-right">{{ __('House number') }}</label>

                                <div class="col-md-6">
                                    <input id="house_number" type="number"
                                           class="form-control @error('house_number') is-invalid @enderror"
                                           name="house_number" value="{{ $team->house_number }}" required
                                           autocomplete="house_number" autofocus>

                                    @error('house_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="postal_code"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Postal code') }}</label>

                                <div class="col-md-6">
                                    <input id="postal_code" type="text"
                                           class="form-control @error('postal_code') is-invalid @enderror"
                                           name="postal_code" value="{{ $team->postal_code }}" required
                                           autocomplete="postal_code" autofocus>

                                    @error('postal_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="town" class="col-md-4 col-form-label text-md-right">{{ __('Town') }}</label>

                                <div class="col-md-6">
                                    <input id="town" type="text"
                                           class="form-control @error('town') is-invalid @enderror" name="town"
                                           value="{{ $team->town }}" required autocomplete="town" autofocus>

                                    @error('town')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Edit team') }}
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

