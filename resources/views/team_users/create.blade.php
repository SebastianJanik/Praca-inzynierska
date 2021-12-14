@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('Apply to the team') }}</div>
                    <div class="card-body">
                        @if(!session('message'))
                        <form method="POST" action="{{ route('team_users.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>
                                <div class="row">
                                    <select id="role" name="role" required>
                                        <option value selected disabled>{{__('Select role')}}</option>
                                        <option value="player">{{ __('Player') }}</option>
                                        <option value="coach">{{ __('Coach') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="league" class="col-md-4 col-form-label text-md-right">{{ __('League') }}</label>
                                <div class="row">
                                    <select id="league" name="league" onchange="teams()" required>
                                        <option value selected disabled>{{__('Select league')}}</option>
                                        @foreach($leagues as $league)
                                        <option value="{{$league->id}}" data-tag>{{$league->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div id="select-team" class="form-group row hidden">
                                <label for="team" class="col-md-4 col-form-label text-md-right">{{ __('Team') }}</label>
                                <div class="row">
                                    <select id="team" name="team" required>
                                        <option value="default" class="option-team-default" selected disabled>{{__('Select team')}}</option>
                                        @foreach($data as $team)
                                            <option class="hidden option-team" value="{{$team->id}}" @if($team->league) data-tag="{{$team->league->id}}" @else data-tag="none" @endif>{{$team->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Apply') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        @else
                            {{session('message')}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function teams()
    {
        let selectedLeague = document.getElementById('league').value
        let teamSelect = document.getElementById('select-team')
        teamSelect.classList.remove('hidden')
        let options = Array.from(document.getElementsByClassName('option-team'))
        options.forEach(function (option){
            if(option.getAttribute('data-tag') === selectedLeague)
                option.classList.remove('hidden')
            else
                option.classList.add('hidden')
        })
    }
</script>
