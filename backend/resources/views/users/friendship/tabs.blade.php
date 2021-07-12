<ul class="nav nav-tabs nav-justified mt-3">
    <li class="nav-item">
        <a class="nav-link {{ $hasBookshelf ? 'active text-dark' : 'text-muted' }}"
            href="{{ route('users.bookshelf', ['name' => $user->name]) }}">
            本棚タイムライン
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $hasPictureBooks ? 'active text-dark' : 'text-muted' }}"
            href="{{ route('users.index', ['name' => $user->name]) }}">
            タイムライン
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $hasLikes ? 'active text-dark' : 'text-muted' }}"
            href="{{ route('users.likes', ['name' => $user->name]) }}">
            レビューいいね
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $hasFollowers ? 'active text-dark' : 'text-muted' }}"
            href="{{ route('users.followers', ['name' => $user->name]) }}">
            本棚フォロー
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $hasFollowings ? 'active text-dark' : 'text-muted' }}"
            href="{{ route('users.followings', ['name' => $user->name]) }}">
            本棚フォロワー
        </a>
    </li>
    @endif
</ul>
