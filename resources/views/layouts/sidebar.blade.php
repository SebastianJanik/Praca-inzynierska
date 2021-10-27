<aside class="sidebar">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('Sidebar') }}</div>
                    <div class="card-header">{{ __('Tables') }}</div>
                    <div class="card-header">{{ __('Timetables') }}</div>
                    <div class="card-body">
                        @if($data != null)
                            @foreach($data as $league)
                                <div class="row">
                                    {{$league['league']->name}}
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>
