<ul class="nav nav-tabs nav-justified mt-3">
    @if ($hasBookshelf || $hasPictureBooks || $hasLikes)
    <li class="nav-item">
        <a class="nav-link {{ $hasBookshelf ? 'active text-dark' : 'text-muted' }}"
            href="{{ route('users.bookshelf', ['name' => $user->name]) }}">
            本棚
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $hasPictureBooks ? 'active text-dark' : 'text-muted' }}"
            href="{{ route('users.show', ['name' => $user->name]) }}">
            タイムライン
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $hasLikes ? 'active text-dark' : 'text-muted' }}"
            href="{{ route('users.likes', ['name' => $user->name]) }}">
            いいね
        </a>
    </li>
    @elseif ($hasFollowers || $hasFollowings)
    <li class="nav-item">
        <a class="nav-link {{ $hasFollowers ? 'active text-dark' : 'text-muted' }}"
            href="{{ route('users.followers', ['name' => $user->name]) }}">
            フォロワー
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $hasFollowings ? 'active text-dark' : 'text-muted' }}"
            href="{{ route('users.followings', ['name' => $user->name]) }}">
            フォロー中
        </a>
    </li>
    @endif
</ul>
