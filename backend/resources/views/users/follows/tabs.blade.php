<ul class="nav nav-pills nav-justified my-2">
    <li class="nav-item bg-white mx-1" style="border-radius: 12px">
        <a href="{{ route('users.followers', ['name' => $user->name]) }}"
            class="nav-link px-1 pt-1 pb-0 btn btn-sm {{ $hasFollowers ? 'active text-white btn-latte' : 'btn-outline-mocha' }}"
            style="border-radius: 12px">
            <small>本棚フォロワー</small><br>
            <b>{{ $family->count_follows }}</b>
        </a>
    </li>
    <li class="nav-item bg-white mx-1" style="border-radius: 12px">
        <a href="{{ route('users.followings', ['name' => $user->name]) }}"
            class="nav-link px-1 pt-1 pb-0 btn btn-sm {{ $hasFollowings ? 'active text-white btn-latte' : 'btn-outline-mocha' }}"
            style="border-radius: 12px">
            <small>本棚フォロー中</small><br>
            <b>{{ $user->count_follows }}</b>
        </a>
    </li>
</ul>
