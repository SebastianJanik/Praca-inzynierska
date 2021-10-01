@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('All leagues') }}</div>

                    <div class="card-body">
                        @foreach($teams as $team)
                            <div class="row">
                                <div class="card">
                                    {{$loop->iteration}}.
                                </div>
                                <div class="card">
                                    {{__($team->name)}}
                                </div>
                                <div class="card-button">
                                    <a href="{{route('teams_edit', $team->id)}}">
                                        <button>{{__('Edit team')}}</button>
                                    </a>
                                </div>
                                <div class="card-button">
                                    <a href="{{route('teams_editAssign', $team->id)}}">
                                        <button>{{__('Assign team')}}</button>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

