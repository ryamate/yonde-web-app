<div class="card mt-3">
    <div class="card-body">
        <div class="row no-gutters">
            <div class="col-sm-3">
                <div class="d-flex flex-row">
                    <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
                        @if ($user->icon_path)
                        <img src="{{ asset($user->icon_path) }}" alt="プロフィール画像" class="bg-white border" style="width: 100px; height:100px;background-position: center
                center;border-radius: 50%;object-fit:cover;" />
                        @else
                        <i class="fas fa-user-circle fa-5x"></i>
                        @endif
                    </a>
                </div>
            </div>
            <div class="col-sm-6">
                <h2 class="h5 card-title m-0">
                    <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
                        {{ $user->nickname }}
                    </a>
                </h2>
                <p class="small text-muted">{{ '@' . $user->name }}</p>
                <p class="small">{{ $user->relation }}</p>
            </div>
            <div class="col-sm-3 d-flex align-items-center">
                @if( Auth::id() !== $user->id )
                <follow-button class="ml-auto" :initial-is-followed-by='@json($user->isFollowedBy(Auth::user()))'
                    :authorized='@json(Auth::check())' endpoint="{{ route('users.follow', ['name' => $user->name]) }}">
                </follow-button>
                @endif
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="card-text">
            <a href="{{ route('users.followings', ['name' => $user->name]) }}" class="text-muted">
                <span class="text-dark"><b>{{ $user->count_followings }}</b></span> フォロー中
            </a>
            <a href="{{ route('users.followers', ['name' => $user->name]) }}" class="text-muted">
                <span class="text-dark"><b>{{ $user->count_followers }}</b></span> フォロワー
            </a>
        </div>
    </div>
</div>
