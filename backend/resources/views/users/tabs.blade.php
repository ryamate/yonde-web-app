<ul class="nav nav-tabs nav-justified mt-3">
    <li class="nav-item">
        <a class="nav-link text-muted {{ $hasStoredPictureBooks ? 'active' : '' }}"
            href="{{ route('users.show', ['yonde_id' => $user->yonde_id]) }}">
            登録絵本
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-muted {{ $hasLikes ? 'active' : '' }}"
            href="{{ route('users.likes', ['yonde_id' => $user->yonde_id]) }}">
            いいね
        </a>
    </li>
</ul>
