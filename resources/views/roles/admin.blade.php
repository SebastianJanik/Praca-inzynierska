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
                            <button>{{__('View leagues')}}</button>
                        </a>
                    </div>
                    <div class="card-button">
                        <a href="{{route('teams_create')}}">
                            <button>{{__('Add team')}}</button>
                        </a>
                        <a href="{{route('teams_index')}}">
                            <button>{{__('Show teams')}}</button>
                        </a>
                    </div>
                    <div class="card-button">
                        <a href="{{route('seasons_create')}}">
                            <button>{{__('Add season')}}</button>
                        </a>
                        <a href="{{route('seasons_index')}}">
                            <button>{{__('View seasons')}}</button>
                        </a>
                    </div>
                    <div class="card-button">
                        <a href="{{route('match_teams_create')}}">
                            <button>{{__('Create timetable')}}</button>
                        </a>
                        <a href="{{route('match_teams_index')}}">
                            <button>{{__('Show timetables')}}</button>
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
                <div class="card-body">
                    <div class="card-button">
                        <a href="{{route('team_users_accept_coach')}}">
                            <button>{{__('Users awaiting approval by the coach')}}</button>
                        </a>
                    </div>
                    <div class="card-button">
                        <a href="{{route('team_users_accept_admin')}}">
                            <button>{{__('Users awaiting approval by the admin')}}</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
