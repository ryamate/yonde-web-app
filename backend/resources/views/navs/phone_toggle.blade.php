{{-- toggle --}}
<div class="d-block d-md-none">
    {{-- search bar (toggle)  --}}
    <li class="nav-item my-2">
        <form action="{{ route('picture_books.search') }}" method="GET">
            @csrf
            <div class="input-group input-group-sm">
                <input type="search" id="search" name="keyword" class="form-control" placeholder="絵本をさがす">
                <div class="input-group-append">
                    <button class="btn btn-outline-teal1 bg-white text-teal1" type="submit" id="search"><i
                            class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
    </li>

    @auth
    <div class="d-flex align-items-center flex-wrap">
        {{-- home button (toggle) --}}
        <a href="{{ route('home') }}" class="btn btn-sm btn-outline-light shadow-sm small mr-3 mb-2">
            <i class="fas fa-home mr-1"></i>ホーム
        </a>
        {{-- picture bookshelf button (toggle) --}}
        <a href="{{ route('families.bookshelf', ["id" => Auth::user()->family_id]) }}"
            class="btn btn-sm btn-outline-light shadow-sm small mr-3 mb-2">
            <i class="fas fa-book mr-1"></i>家族の本棚
        </a>
        {{-- timeline button (toggle) --}}
        <a href="{{ route('families.index', ['id' => Auth::user()->family_id]) }}"
            class="btn btn-sm btn-outline-light shadow-sm small mr-3 mb-2">
            <i class="far fa-clock mr-1"></i>家族のタイムライン
        </a>
        {{-- my page button (toggle) --}}
        <a href="{{ route("users.show", ["name" => Auth::user()->name]) }}"
            class="btn btn-sm btn-outline-light shadow-sm small mr-3 mb-2">
            <i class="far fa-user-circle mr-1"></i>{{ Auth::user()->nickname }}さんのページ
        </a>
        {{-- setting profile button (toggle) --}}
        <a href="{{ route('families.setting') }}" class="btn btn-sm btn-outline-light shadow-sm small mr-3 mb-2">
            <i class="fas fa-cog mr-1"></i>家族設定
        </a>
        {{-- logout button (toggle) --}}
        <form method="POST" name="form1" action="{{ route('logout') }}">
            @csrf
            <a href="javascript:form1.submit()" class="btn btn-sm btn-outline-light shadow-sm small mr-3 mb-2">
                <i class="fas fa-sign-out-alt mr-1"></i>ログアウト
            </a>
        </form>
    </div>
    @endauth

    @guest
    <li class="nav-item mb-1">
        <a href="{{ route('about') }}" class="btn btn-sm btn-block bg-teal1 text-white font-weight-bold">よんでとは</a>
    </li>
    {{-- register user button (toggle) --}}
    <li class="nav-item mb-1">
        <a href="{{ route('register') }}" class="btn btn-sm btn-block bg-warning text-white font-weight-bold">新規登録</a>
    </li>
    {{-- login user button (toggle) --}}
    <li class="nav-item mb-1">
        <a href="{{ route('login') }}"
            class="btn btn-sm btn-block btn-outline-teal1 bg-white text-teal1 font-weight-bold">ログイン</a>
    </li>
    @endguest
</div>
