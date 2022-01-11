<div class="card-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="row-flex">
        <div class="dropdown card-button m-1">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                    data-bs-toggle="dropdown" aria-expanded="false">{{__('Create')}}</button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="{{route('leagues.create')}}">{{__('Create league')}}</a></li>
                <li><a class="dropdown-item" href="{{route('teams.create')}}">{{__('Add team')}}</a></li>
                <li><a class="dropdown-item" href="{{route('seasons.create')}}">{{__('Add season')}}</a></li>
                <li><a class="dropdown-item" href="{{route('match_teams.create')}}">{{__('Create timetable')}}</a></li>
            </ul>
        </div>
        <div class="dropdown card-button m-1">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2"
                    data-bs-toggle="dropdown" aria-expanded="false">{{__('Show')}}</button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                <li><a class="dropdown-item" href="{{route('seasons.index')}}">{{__('View seasons')}}</a></li>
                <li><a class="dropdown-item" href="{{route('league_seasons.index')}}">{{__('Show timetables')}}</a></li>
            </ul>
        </div>
        <div class="card-button m-1">
            <a href="{{route('team_users.accept_admin')}}">
                <button class="btn btn-secondary">{{__('Users awaiting approval by the admin')}}</button>
            </a>
        </div>
        <div class="card-button m-1">
            <a href="{{route('teams.index')}}">
                <button class="btn btn-secondary">{{__('All teams')}}</button>
            </a>
        </div>
    </div>
</div>
