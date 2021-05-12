<div class="card mt-3">
    <div class="card-body">
        <div class="row no-gutters">
            <div class="col-sm-3">
                <div class="d-flex flex-row">
                    <a href="{{ route('users.show', ['yonde_id' => $user->yonde_id]) }}" class="text-dark">
                        @if ($user->user_icon)
                        <img src="{{ asset('storage/user_images/' . $user->user_icon) }}" alt="プロフィール画像"
                            class="bg-white border" style="width: 100px; height:100px;background-position: center
                center;border-radius: 50%;object-fit:cover;" />
                        @else
                        <i class="fas fa-user-circle fa-5x"></i>
                        @endif
                    </a>
                </div>
            </div>
            <div class="col-sm-6">
                <h2 class="h5 card-title m-0">
                    <a href="{{ route('users.show', ['yonde_id' => $user->yonde_id]) }}" class="text-dark">
                        {{ $user->name }}
                    </a>
                </h2>
                <p class="small text-muted">{{ '@' . $user->yonde_id }}</p>
                <p class="small">{{ $user->introduction }}</p>
            </div>
            <div class="col-sm-3 d-flex align-items-center">
                @if( Auth::id() !== $user->id )
                <follow-button class="ml-auto" :initial-is-followed-by='@json($user->isFollowedBy(Auth::user()))'
                    :authorized='@json(Auth::check())'
                    endpoint="{{ route('users.follow', ['yonde_id' => $user->yonde_id]) }}">
                </follow-button>
                @endif
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="card-text">
            <a href="{{ route('users.followings', ['yonde_id' => $user->yonde_id]) }}" class="text-muted">
                <span class="text-dark"><b>{{ $user->count_followings }}</b></span> フォロー中
            </a>
            <a href="{{ route('users.followers', ['yonde_id' => $user->yonde_id]) }}" class="text-muted">
                <span class="text-dark"><b>{{ $user->count_followers }}</b></span> フォロワー
            </a>
        </div>
    </div>
</div>

<div class="row no-gutters">
    <div class="col-sm-12">
    </div>
    <div class="col-sm-3">
    </div>

    <div class="col-sm-6 d-flex align-items-center">
    </div>
    <div class="col-sm-3 d-flex align-items-center">
        <div class="card-body">
        </div>
    </div>
</div>
