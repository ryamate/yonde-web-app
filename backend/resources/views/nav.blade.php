<nav class="navbar navbar-expand-md navbar-light bg-teal1 shadow-sm bd-navbar py-1"
    style="vertical-align: middle; position: sticky; top: 0; z-index: 1071; background: linear-gradient(-135deg, #22968a, #45d9c8) fixed; opacity: 0.97;">

    {{-- left: application logo --}}
    <a class="navbar-brand mr-2 p-0" href="{{ route('picture_books.home') }}">
        <img src="{{ asset('image/logo.png') }}" height="30"
            class="d-inline-block align-top text-white text-decoration-none" alt="yonde">
    </a>

    {{-- toggle button --}}
    <button class="navbar-toggler p-1" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        {{-- left: application name --}}
        <ul class="navbar-nav mr-auto d-none d-md-block">
            <li class="nav-item">
                <a class="nav-link text-white text-decoration-none mb-0 h4"
                    href="{{ route('picture_books.home') }}">よんで</a>
            </li>
        </ul>

        {{-- right: --}}
        <ul class="navbar-nav">
            {{-- pc --}}
            {{-- search bar --}}
            <div class="d-none d-md-block">
                <li class="nav-item d-flex align-items-center justify-content-center">
                    <form action="{{ route('picture_books.search') }}" method="GET" class="form-inline">
                        @csrf
                        <div class="input-group input-group-sm">
                            <input type="search" id="search" name="keyword" class="form-control border"
                                placeholder="絵本をさがす">
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
                <li class="nav-item d-flex align-items-center justify-content-center">
                    <a href="{{ route('picture_books.index') }}" title="絵本棚"
                        class="nav-link btn-light text-teal1 d-flex align-items-center justify-content-center ml-3 mr-1"
                        style="width: 35px; height:35px;border-radius: 4px;"><i class="fas fa-book fa-lg"></i></a>
                </li>
            </div>
            {{-- timeline button --}}
            <div class="d-none d-md-block">
                <li class="nav-item d-flex align-items-center justify-content-center">
                    <a href="{{ route('picture_books.index') }}" title="タイムライン"
                        class="nav-link btn-light text-teal1 d-flex align-items-center justify-content-center mx-1"
                        style="width: 35px; height:35px; border-radius: 4px;"><i class="far fa-clock fa-lg"></i></a>
                </li>
            </div>
            {{-- setting profile button --}}
            <div class="d-none d-md-block">
                <li class="nav-item d-flex align-items-center justify-content-center">
                    <a href="{{ route('users.show_setting_profile', ['yonde_id' => Auth::user()->yonde_id]) }}"
                        title="プロフィール設定"
                        class="nav-link btn-light text-teal1 d-flex align-items-center justify-content-center mx-1"
                        style="width: 35px; height:35px; border-radius: 4px;"><i class="fas fa-cog fa-lg"></i></a>
                </li>
            </div>
            {{-- profile image(home, logout) button --}}
            <li class="nav-item d-flex align-items-center justify-content-center">
                <div class="d-none d-md-block">
                    <div class="mx-2">
                        <div class="dropdown drop-hover">
                            <a role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" title="マイページ"
                                onclick="location.href='{{ route("users.show", ["yonde_id" => Auth::user()->yonde_id]) }}'">
                                @if (Auth::user()->user_icon)
                                <img src="{{ asset('storage/user_images/' . Auth::user()->user_icon) }}" alt="プロフィール画像"
                                    class="rounded-circle bg-white border" width="35" height="35" style="background-position: center center;
                                object-fit:cover;" />
                                @else
                                <i class="far fa-user-circle fa-2x text-white rounded-circle"></i>
                                @endif
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                <a href="{{ route('picture_books.home') }}" class="dropdown-item small"><i
                                        class="fas fa-home"></i> ホーム</a>
                                {{-- logout button 1/2 --}}
                                <button form="logout-button" class="dropdown-item small"><i
                                        class="fas fa-sign-out-alt"></i> ログアウト</button>
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
                    <a href="{{ route('picture_books.about') }}"
                        class="card-title text-decoration-none text-white small ml-3" role="button"><b>よんでとは</b></a>
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

            {{-- toggle --}}
            <div class="d-block d-md-none">
                {{-- search bar (toggle)  --}}
                <li class="nav-item mt-2 mb-1">
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
                <div class="row">
                    {{-- picture bookshelf button (toggle) --}}
                    <div class="col-6">
                        <li class="nav-item d-flex align-items-center">
                            <a href="{{ route('picture_books.index') }}" title="絵本棚" class="nav-link"><i
                                    class="fas fa-book"></i> 絵本棚</a>
                        </li>
                    </div>
                    {{-- timeline button (toggle) --}}
                    <div class="col-6">
                        <li class="nav-item d-flex align-items-center">
                            <a href="{{ route('picture_books.index') }}" title="タイムライン" class="nav-link"><i
                                    class="far fa-clock"></i> タイムライン</a>
                        </li>
                    </div>
                    {{-- my page button (toggle) --}}
                    <div class="col-6">
                        <li class="nav-item d-flex align-items-center">
                            <a href="{{ route("users.show", ["yonde_id" => Auth::user()->yonde_id]) }}" title="マイページ"
                                class="nav-link"><i class="fas fa-user-circle"></i> マイページ</a>
                        </li>
                    </div>
                    {{-- setting profile button (toggle) --}}
                    <div class="col-6">
                        <li class="nav-item d-flex align-items-center">
                            <a href="{{ route('users.show_setting_profile', ['yonde_id' => Auth::user()->yonde_id]) }}"
                                title="プロフィール設定" class="nav-link"><i class="fas fa-cog"></i> プロフィール設定</a>
                        </li>
                    </div>
                    {{-- home button (toggle) --}}
                    <div class="col-6">
                        <li class="nav-item d-flex align-items-center">
                            <a href="{{ route('picture_books.home') }}" title="ホーム" class="nav-link"><i
                                    class="fas fa-home"></i> ホーム</a>
                        </li>
                    </div>
                    {{-- logout button (toggle) --}}
                    <div class="col-6">
                        <li class="nav-item d-flex align-items-center">
                            <form method="POST" name="form1" action="{{ route('logout') }}">
                                @csrf
                                <a href="javascript:form1.submit()" class="nav-link"><i class="fas fa-sign-out-alt"></i>
                                    ログアウト</a>
                            </form>
                        </li>
                    </div>
                </div>
                @endauth

                @guest
                <li class="nav-item mb-1">
                    <a href="{{ route('picture_books.about') }}"
                        class="btn btn-sm btn-block bg-teal1 text-white font-weight-bold">よんでとは</a>
                </li>
                {{-- register user button (toggle) --}}
                <li class="nav-item mb-1">
                    <a href="{{ route('register') }}"
                        class="btn btn-sm btn-block bg-warning text-white font-weight-bold">新規登録</a>
                </li>
                {{-- login user button (toggle) --}}
                <li class="nav-item mb-1">
                    <a href="{{ route('login') }}"
                        class="btn btn-sm btn-block btn-outline-teal1 bg-white text-teal1 font-weight-bold">ログイン</a>
                </li>
                @endguest
            </div>
        </ul>
    </div>
</nav>
