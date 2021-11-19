<div class="card-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    {{ __('You are logged in!') }}
    <div class="card-button">
        <a href="{{route('leagues.create')}}">
            <button>{{__('Create league')}}</button>
        </a>
        <a href="{{route('teams.create')}}">
            <button>{{__('Add team')}}</button>
        </a>
        <a href="{{route('teams.index')}}">
            <button>{{__('Show teams')}}</button>
        </a>
        <a href="{{route('seasons.create')}}">
            <button>{{__('Add season')}}</button>
        </a>
        <a href="{{route('seasons.index')}}">
            <button>{{__('View seasons')}}</button>
        </a>
        <a href="{{route('match_teams.create')}}">
            <button>{{__('Create timetable')}}</button>
        </a>
        <a href="{{route('league_seasons.index')}}">
            <button>{{__('Show timetables')}}</button>
        </a>
        <a href="{{route('users.players_index')}}">
            <button>{{__('Show my players')}}</button>
        </a>
        <a href="{{route('team_users.create')}}">
            <button>{{__('Apply to the team')}}</button>
        </a>
        <a href="{{route('users.referee_create')}}">
            <button>{{__('Become a referee')}}</button>
        </a>
        <a href="{{route('team_users.accept_coach')}}">
            <button>{{__('Users awaiting approval by the coach')}}</button>
        </a>
        <a href="{{route('team_users.accept_admin')}}">
            <button>{{__('Users awaiting approval by the admin')}}</button>
        </a>
    </div>
</div>
