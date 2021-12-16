<div class="card-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="row-flex">
        <div class="card-button">
            <a href="{{route('seasons.index')}}">
                <button class="btn btn-secondary">{{__('View seasons')}}</button>
            </a>
        </div>
        <div class="card-button">
            <a href="{{route('league_seasons.index')}}">
                <button class="btn btn-secondary">{{__('Show timetables')}}</button>
            </a>
        </div>
        <div class="card-button">
            <a href="{{route('team_users.create')}}">
                <button class="btn btn-secondary">{{__('Apply to the team')}}</button>
            </a>
        </div>
        <div class="card-button">
            <a href="{{route('users.referee_create')}}">
                <button class="btn btn-secondary">{{__('Become a referee')}}</button>
            </a>
        </div>
        <div class="card-button">
            <a href="{{route('teams.index')}}">
                <button class="btn btn-secondary">{{__('All teams')}}</button>
            </a>
        </div>
    </div>
</div>
