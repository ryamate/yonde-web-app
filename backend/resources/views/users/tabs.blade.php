<ul class="nav nav-tabs nav-justified mt-3">
    @if ($hasStoredPictureBooks || $hasLikes)
    <li class="nav-item">
        <a class="nav-link {{ $hasStoredPictureBooks ? 'active text-dark' : 'text-muted' }}"
            href="{{ route('users.show', ['yonde_id' => $user->yonde_id]) }}">
            登録絵本
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
