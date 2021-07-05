{{-- pc --}}
{{-- search bar --}}
<div class="d-none d-md-block">
    <li class="nav-item d-flex align-items-center justify-content-center">
        <form action="{{ route('picture_books.search') }}" method="GET" class="form-inline">
            @csrf
            <div class="input-group input-group-sm">
                <input type="search" id="search" name="keyword" class="form-control border" placeholder="絵本をさがす">
                <div class="input-group-append">
                    <button class="btn border bg-white text-teal1" type="submit" id="search"><i
                            class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
    </li>
</div>

@auth
{{-- picture bookshelf button --}}
<div class="d-none d-md-block">
    <li class="nav-item d-flex align-items-center justify-content-center btn-group drop-hover">
        <a role="button" onclick="location.href='{{ route('families.bookshelf', ['id' => Auth::user()->family_id]) }}'"
            title="家族の本棚"
            class="nav-link btn btn-light text-teal1 d-flex align-items-center justify-content-center ml-3 mr-1"
            style="width: 35px; height:35px; border-radius: 4px;" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <i class="fas fa-book fa-lg"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right mt-0">
            <a class="dropdown-item small text-center"
                href="{{ route('families.bookshelf', ['id' => Auth::user()->family_id]) }}">
                <i class="fas fa-book fa-lg mr-1"></i>本棚
            </a>
            <a class="dropdown-item small text-center"
                href="{{ route('families.read', ['id' => Auth::user()->family_id]) }}">
                よんだ絵本
            </a>
            <a class="dropdown-item small text-center"
                href="{{ route('families.curious', ['id' => Auth::user()->family_id]) }}">
                きになる絵本
            </a>
        </div>
    </li>


</div>
{{-- timeline button --}}
<div class="d-none d-md-block">
    <li class="nav-item d-flex align-items-center justify-content-center btn-group drop-hover">
        <a role="button" onclick="location.href='{{ route('families.index', ['id' => Auth::user()->family_id]) }}'"
            title="家族のタイムライン"
            class="nav-link btn btn-light text-teal1 d-flex align-items-center justify-content-center mx-1"
            style="width: 35px; height:35px; border-radius: 4px;" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <i class="far fa-clock fa-lg"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right mt-0">
            <a class="dropdown-item small text-center"
                href="{{ route('families.index', ['id' => Auth::user()->family_id]) }}">
                <i class="far fa-clock fa-lg mr-1"></i>タイムライン
            </a>
            <a class="dropdown-item small text-center"
                href="{{ route('families.read_record', ["id" =>  Auth::user()->family->id]) }}">
                <i class="fas fa-book-reader mr-1"></i>よんだよ記録
            </a>
        </div>
    </li>
</div>
{{-- setting button --}}
<div class="d-none d-md-block">
    <li class="nav-item d-flex align-items-center justify-content-center btn-group drop-hover">
        <a role="button" onclick="location.href='{{ route('users.setting_profile') }}'" title="設定"
            class="nav-link btn btn-light text-teal1 d-flex align-items-center justify-content-center mx-1"
            style="width: 35px; height:35px; border-radius: 4px;" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <i class="fas fa-cog fa-lg"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right mt-0">
            <a class="dropdown-item small text-center" href="{{ route('users.setting_profile') }}">
                <i class="fas fa-cog fa-lg mr-1"></i>ユーザー設定
            </a>
            <a class="dropdown-item small text-center" href="{{ route('families.setting') }}">
                <i class="fas fa-cogs mr-1"></i>家族設定
            </a>
        </div>
    </li>
</div>
{{-- profile image(home, logout) button --}}
<li class="nav-item d-flex align-items-center justify-content-center">
    <div class="d-none d-md-block">
        <div class="mx-2">
            <div class="dropdown drop-hover">
                <a role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                    title="{{ Auth::user()->nickname }}さんのタイムライン"
                    onclick="location.href='{{ route("users.show", ["name" => Auth::user()->name]) }}'">
                    @if (Auth::user()->icon_path)
                    <img src="{{ asset(Auth::user()->icon_path) }}" alt="プロフィール画像"
                        class="rounded-circle bg-white border" width="35" height="35" style="background-position: center center;
                                object-fit:cover;" />
                    @else
                    <i class="far fa-user-circle fa-2x text-white rounded-circle"></i>
                    @endif
                </a>

                <div class="dropdown-menu dropdown-menu-right mt-0" aria-labelledby="dropdownMenuLink">
                    <a href="{{ route('home') }}" class="dropdown-item small text-center">
                        <i class="fas fa-home mr-1"></i>ホーム
                    </a>
                    {{-- logout button 1/2 --}}
                    <button form="logout-button" class="dropdown-item small text-center"><i
                            class="fas fa-sign-out-alt mr-1"></i>ログアウト</button>
                </div>
            </div>
        </div>
    </div>
</li>
{{-- logout button 2/2 --}}
<form action="{{ route('logout') }}" method="POST" id="logout-button">
    @csrf
</form>
@endauth

@guest
<div class="d-none d-md-block">
    <li class="nav-item">
        <a href="{{ route('about') }}" class="card-title text-decoration-none text-white small ml-3"
            role="button"><b>よんでとは</b></a>
    </li>
</div>
{{-- register user button --}}
<div class="d-none d-md-block">
    <li class="nav-item">
        <a href="{{ route('register') }}"
            class="btn btn-sm shadow-sm bg-warning text-decoration-none text-white font-weight-bold mx-2"
            role="button">新規登録</a>
    </li>
</div>
{{-- login user button --}}
<div class="d-none d-md-block">
    <li class="nav-item">
        <a href="{{ route('login') }}"
            class="btn btn-sm shadow-sm btn-outline-teal1 bg-white text-decoration-none text-teal1 font-weight-bold mx-2"
            role="button" disabled>ログイン</a>
    </li>
</div>
@endguest
