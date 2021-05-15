<ul class="nav nav-tabs nav-justified mt-3">
    @if ($hasBookshelf || $hasStoredPictureBooks || $hasLikes)
    <li class="nav-item">
        <a class="nav-link {{ $hasBookshelf ? 'active text-dark' : 'text-muted' }}"
            href="{{ route('users.bookshelf', ['yonde_id' => $user->yonde_id]) }}">
            本棚
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $hasStoredPictureBooks ? 'active text-dark' : 'text-muted' }}"
            href="{{ route('users.show', ['yonde_id' => $user->yonde_id]) }}">
            タイムライン
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $hasLikes ? 'active text-dark' : 'text-muted' }}"
            href="{{ route('users.likes', ['yonde_id' => $user->yonde_id]) }}">
            いいね
        </a>
    </li>
    @elseif ($hasFollowers || $hasFollowings)
    <li class="nav-item">
        <a class="nav-link {{ $hasFollowers ? 'active text-dark' : 'text-muted' }}"
            href="{{ route('users.followers', ['yonde_id' => $user->yonde_id]) }}">
            フォロワー
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $hasFollowings ? 'active text-dark' : 'text-muted' }}"
            href="{{ route('users.followings', ['yonde_id' => $user->yonde_id]) }}">
            フォロー中
        </a>
    </li>
    @endif
</ul>
