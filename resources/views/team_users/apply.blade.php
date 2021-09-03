@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Apply to the team') }}</div>

                    <div class="card-body">
                    <apply-inputs></apply-inputs>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


{{--<form method="POST" action="{{ route('team_users_create') }}">--}}
{{--    @csrf--}}

{{--    <div class="form-group row">--}}
{{--        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('League') }}</label>--}}

{{--        <div class="col-md-6">--}}
{{--            <input id="name" type="text"--}}
{{--                   class="form-control @error('name') is-invalid @enderror" name="name"--}}
{{--                   value="{{ old('name') }}" required autocomplete="name" autofocus>--}}

{{--            @error('name')--}}
{{--            <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--            @enderror--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="form-group row">--}}
{{--        <label for="surname"--}}
{{--               class="col-md-4 col-form-label text-md-right">{{ __('Surname') }}</label>--}}

{{--        <div class="col-md-6">--}}
{{--            <input id="surname" type="text"--}}
{{--                   class="form-control @error('surname') is-invalid @enderror" name="surname"--}}
{{--                   value="{{ old('surname') }}" required autocomplete="surname" autofocus>--}}

{{--            @error('surname')--}}
{{--            <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--            @enderror--}}
{{--        </div>--}}
{{--        <apply-inputs></apply-inputs>--}}
{{--        --}}{{--                                <example-component></example-component>--}}
{{--    </div>--}}

{{--    <div class="form-group row mb-0">--}}
{{--        <div class="col-md-6 offset-md-4">--}}
{{--            <button type="submit" class="btn btn-primary">--}}
{{--                {{ __('Apply') }}--}}
{{--            </button>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</form>--}}
