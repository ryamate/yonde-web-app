<ul class="nav nav-pills nav-justified my-2">
    <li class=" nav-item bg-white mx-1" style="border-radius: 12px">
        <a href="{{ route('users.index', ["name" =>  $user->name]) }}"
            class="nav-link px-1 pt-1 pb-0 btn btn-sm {{ $hasStored ? 'active text-white btn-teal1' : 'btn-outline-teal1' }}"
            style="border-radius: 12px">
            <small>登録絵本</small><br>
            <b>{{ $storedCount }}</b>
        </a>
    </li>
    <li class="nav-item bg-white mx-1" style="border-radius: 12px">
        <a href="{{ route('users.read_record', ["name" =>  $user->name]) }}"
            class="nav-link px-1 pt-1 pb-0 btn btn-sm {{ $hasReadRecord ? 'active text-white btn-teal1' : 'btn-outline-teal1' }}"
            style="border-radius: 12px">
            <small>よんだよ記録</small><br>
            <b>{{ $readRecordCount }}</b>
        </a>
    </li>
    <li class="nav-item bg-white mx-1" style="border-radius: 12px">
        <a href="{{ route('users.likes', ["name" =>  $user->name]) }}"
            class="nav-link px-1 pt-1 pb-0 btn btn-sm {{ $hasLikes ? 'active text-white btn-teal1' : 'btn-outline-teal1' }}"
            style="border-radius: 12px">
            <small>いいねした</small><br>
            レビュー
        </a>
    </li>
</ul>
