@if ($hasBookshelf || $hasPictureBooks)
<div class="card-body p-2">
    <ul class="nav nav-pills nav-justified">
        <li class="nav-item small">
            <a class="nav-link py-1 {{ $hasBookshelf ? 'active text-dark bg-light' : 'text-muted' }}"
                href="{{ route('families.bookshelf', ["id" => Auth::user()->family_id]) }}">
                <i class="fas fa-book"></i>本棚
            </a>
        </li>
        <li class="nav-item small">
            <a class="nav-link py-1 {{ $hasPictureBooks ? 'active text-dark bg-light ' : 'text-muted' }}"
                href="{{ route('families.index', ["id" => Auth::user()->family_id]) }}">
                <i class="far fa-clock"></i>タイムライン
            </a>
        </li>
        {{-- <li class="nav-item">
        <a class="nav-link {{ $hasLikes ? 'active text-dark' : 'text-muted' }}"
        href="{{ route('users.likes', ['name' => $user->name]) }}">
        いいね
        </a>
        </li> --}}
    </ul>
</div>
@elseif ($hasStored || $hasCurious || $hasRead)
<ul class="nav nav-pills nav-justified mt-3">
    <li class="nav-item">
        <a href="{{ route('families.bookshelf', ["id" => Auth::user()->family_id]) }}"
            class="nav-link px-1 mx-1 pt-1 pb-0 shadow-sm {{ $hasStored ? 'active text-white bg-teal1' : 'text-muted bg-white' }}"
            style="border-radius: 12px">
            <small>登録絵本</small><br>
            <b>{{ $storedCount }}</b>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link px-1 mx-1 pt-1 pb-0 shadow-sm {{ $hasCurious ? 'active text-dark' : 'text-muted bg-white' }}"
            href="{{ route('families.bookshelf', ["id" => Auth::user()->family_id]) }}" style="border-radius: 12px">
            <small>きになる</small><br>
            <b>10</b>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link px-1 mx-1 pt-1 pb-0 shadow-sm {{ $hasRead ? 'active text-dark' : 'text-muted bg-white' }}"
            href="{{ route('families.bookshelf', ["id" => Auth::user()->family_id]) }}" style="border-radius: 12px">
            <small>よんだ</small><br>
            <b>10</b>
        </a>
    </li>
</ul>
@endif
