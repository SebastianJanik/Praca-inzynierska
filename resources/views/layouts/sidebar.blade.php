    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="tables">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-tables" aria-expanded="true" aria-controls="panelsStayOpen-tables">
                                    <span>{{ __('Tables') }}</span>
                                </button>
                            </h2>
                            <div id="panelsStayOpen-tables" class="accordion-collapse collapse" aria-labelledby="tables">
                                <div class="accordion-body">
                                    @foreach($dataSidebar as $league)
                                        <a href="{{route('league_seasons.show_table', $league->league_season_id)}}">{{$league->league->name}}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="timetables">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-timetables" aria-expanded="false" aria-controls="panelsStayOpen-timetables">
                                    <span>{{ __('Timetables') }}</span>
                                </button>
                            </h2>
                            <div id="panelsStayOpen-timetables" class="accordion-collapse collapse" aria-labelledby="timetables">
                                <div class="accordion-body">
                                    @if($dataSidebar != null)
                                        @foreach($dataSidebar as $league)
                                            <a href="{{route('league_seasons.show', $league->league_season_id)}}">{{$league->league->name}}</a>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="archive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-archive" aria-expanded="false" aria-controls="panelsStayOpen-archive">
                                    <span>{{ __('Archive') }}</span>
                                </button>
                            </h2>
                            <div id="panelsStayOpen-archive" class="accordion-collapse collapse" aria-labelledby="archive">
                                <div class="accordion-body">
                                    @if($archive != null)
                                        @foreach($archive as $season)
                                            <a href="{{route('seasons.show', $season->id)}}">{{$season->name}}</a>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
