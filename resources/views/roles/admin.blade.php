<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('You are logged in!') }}
                </div>
                <div class="card-body">
                    <div class="card-button">
                        <a href="{{route('leagues_create')}}">
                            <button>{{__('Create league')}}</button>
                        </a>
                        <a href="{{route('leagues_index')}}">
                            <button>{{__('View league')}}</button>
                        </a>
                    </div>
                    <div class="card-button">
                        <a href="{{route('teams_create')}}">
                            <button>{{__('Add team')}}</button>
                        </a>
                    </div>
                    <div class="card-button">
                        <a href="{{route('seasons_create')}}">
                            <button>{{__('Add season')}}</button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-button">
                        <a href="{{route('team_users_create')}}">
                            <button>{{__('Apply to the team')}}</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
