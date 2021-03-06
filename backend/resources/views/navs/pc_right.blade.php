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
        <a role="button"
            onclick="location.href='{{ route('families.bookshelf', ['name' => Auth::user()->family->name]) }}'"
            title="家族の本棚"
            class="nav-link btn btn-light text-teal1 d-flex align-items-center justify-content-center ml-3 mr-1"
            style="width: 35px; height:35px; border-radius: 4px;" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <i class="fas fa-book fa-lg fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right mt-0">
            <a class="dropdown-item small"
                href="{{ route('families.bookshelf', ['name' => Auth::user()->family->name]) }}">
                <i class="fas fa-book fa-lg text-mocha mr-1"></i>家族の本棚
            </a>
            <a class="dropdown-item small" href="{{ route('families.read', ['name' => Auth::user()->family->name]) }}">
                <i class="fas fa-book fa-lg text-latte mr-1"></i>よんだ絵本
            </a>
            <a class="dropdown-item small"
                href="{{ route('families.curious', ['name' => Auth::user()->family->name]) }}">
                <i class="fas fa-book fa-lg text-latte mr-1"></i>きになる絵本
            </a>
        </div>
    </li>


</div>
{{-- timeline button --}}
<div class="d-none d-md-block">
    <li class="nav-item d-flex align-items-center justify-content-center btn-group drop-hover">
        <a role="button" onclick="location.href='{{ route('families.index', ['name' => Auth::user()->family->name]) }}'"
            title="家族のタイムライン"
            class="nav-link btn btn-light text-teal1 d-flex align-items-center justify-content-center mx-1"
            style="width: 35px; height:35px; border-radius: 4px;" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <i class="far fa-clock fa-lg fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right mt-0">
            <a class="dropdown-item small" href="{{ route('families.index', ['name' => Auth::user()->family->name]) }}">
                <i class="far fa-clock fa-lg text-teal1 mr-1"></i>タイムライン
            </a>
            <a class="dropdown-item small"
                href="{{ route('families.read_record', ['name' => Auth::user()->family->name]) }}">
                <i class="fas fa-book-open text-teal1 mr-1"></i>よんだよ記録
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
            <i class="fas fa-cog fa-lg fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right mt-0">
            <a class="dropdown-item small" href="{{ route('users.setting_profile') }}">
                <i class="fas fa-cog fa-lg text-secondary mr-1"></i>ユーザー設定
            </a>
            <a class="dropdown-item small" href="{{ route('families.setting') }}">
                <i class="fas fa-cogs text-secondary mr-1"></i>家族設定
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
                    title="{{ Auth::user()->nickname }}さんのページ"
                    onclick="location.href='{{ route("users.index", ["name" => Auth::user()->name]) }}'">
                    @if (Auth::user()->icon_path)
                    <img src="{{ asset(Auth::user()->icon_path) }}" alt="プロフィール画像"
                        class="rounded-circle bg-white border" width="35" height="35" style="background-position: center center;
                                object-fit:cover;" />
                    @else
                    <span class="fa-stack">
                        <i class="fas fa-circle fa-stack-2x text-white"></i>
                        <i class="far fa-user-circle fa-stack-2x fa-inverse text-secondary"></i>
                    </span>
                    @endif
                </a>

                <div class="dropdown-menu dropdown-menu-right mt-0" aria-labelledby="dropdownMenuLink">
                    <a href="{{ route('users.index', ['name' => Auth::user()->name]) }}" class="dropdown-item small">
                        <i class="far fa-user-circle text-secondary mr-1"></i>マイページ
                    </a>
                    <a href="{{ route('home') }}" class="dropdown-item small">
                        <i class="fas fa-home text-dark-mocha mr-1"></i>ホーム
                    </a>
                    <button form="logout-button" class="dropdown-item small"><i
                            class="fas fa-sign-out-alt text-pink mr-1"></i>ログアウト</button>
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
        <a href="{{ route('register') }}" class="btn btn-sm btn-pink shadow-sm text-white mx-2" role="button">
            <b>新規登録</b>
        </a>
    </li>
</div>
{{-- login user button --}}
<div class="d-none d-md-block">
    <li class="nav-item">
        <a href="{{ route('login') }}"
            class="btn btn-sm shadow-sm btn-outline-teal1 bg-white text-decoration-none text-teal1 font-weight-bold mx-2"
            role="button" disabled>
            <b>ログイン</b>
        </a>
    </li>
</div>
@endguest
