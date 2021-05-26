<div class="card mt-3">
    <div class="card-body">
        <div class="row no-gutters">
            <div class="col-sm-2">
                <div class="d-flex flex-row">
                    <a href="{{ route('users.show', ['yonde_id' => $person->yonde_id]) }}" class="text-dark">
                        @if ($person->icon_path)
                        <img src="{{ asset($person->icon_path) }}" alt="プロフィール画像" class="bg-white border" style="width: 50px; height:50px;background-position: center
                                center;border-radius: 50%;object-fit:cover;" />
                        @else
                        <i class="fas fa-user-circle fa-3x"></i>
                        @endif
                    </a>
                </div>
            </div>
            <div class="col-sm-7">
                <h2 class="h5 card-title m-0">
                    <a href="{{ route('users.show', ['yonde_id' => $person->yonde_id]) }}"
                        class="text-dark">{{ $person->name }}</a>
                </h2>
                <p class="small text-muted">{{ '@' . $person->yonde_id }}</p>
                <p class="small">{{ $person->introduction }}</p>
            </div>
            <div class="col-sm-3 d-flex align-items-center">
                @if( Auth::id() !== $person->id )
                <follow-button class="ml-auto" :initial-is-followed-by='@json($person->isFollowedBy(Auth::user()))'
                    :authorized='@json(Auth::check())'
                    endpoint="{{ route('users.follow', ['yonde_id' => $person->yonde_id]) }}">
                </follow-button>
                @endif
            </div>
        </div>
    </div>
</div>
