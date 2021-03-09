<nav class="navbar navbar-expand-md navbar-light bg-teal1 shadow-sm bd-navbar py-1" style="vertical-align: middle; position: sticky; top: 0; z-index: 1071; background: linear-gradient(-135deg, #22968a, #45d9c8) fixed; opacity: 0.97;">

    {{-- left: application logo --}}
    <a class="navbar-brand mr-2 p-0" href="/">
        <img src="image/logo.png" height="45" class="d-inline-block align-top text-white text-decoration-none" alt=" yonde">
    </a>

    {{-- toggle button --}}
    <button class="navbar-toggler p-1" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        {{-- left: application name --}}
        <ul class="navbar-nav mr-auto d-none d-md-block">
            <li class="nav-item">
                <a class="nav-link text-white text-decoration-none mb-0 h4" href="/">よんで</a>
            </li>
        </ul>

        {{-- right: --}}
        <ul class="navbar-nav">

            {{-- search bar --}}
            <li class="nav-item d-flex align-items-center justify-content-center">
                <div class="d-none d-md-block">
                    <form action="{{ route('search') }}" method="GET" class="form-inline">
                        @csrf
                        <div class="input-group input-group-sm">
                            <input type="search" id="search" name="keyword" class="form-control" placeholder="絵本をさがす">
                            <div class="input-group-append">
                                <button class="btn btn-outline-teal1 bg-white text-teal1" type="submit" id="search"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>
            {{-- search bar (toggle) --}}
            <li class="nav-item">
                <div class="d-block d-md-none pt-2">
                    <form action="{{ route('search') }}" method="GET" class="form-inline">
                        @csrf
                        <div class="input-group input-group-sm">
                            <input type="search" id="search" name="keyword" class="form-control" placeholder="絵本をさがす">
                            <div class="input-group-append">
                                <button class="btn btn-outline-teal1 bg-white text-teal1" type="submit" id="search"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>

            @auth
            {{-- picture bookshelf button --}}
            <li class="nav-item d-flex align-items-center justify-content-center">
                <div class="d-none d-md-block">
                    <a href="" title="絵本棚" class="nav-link btn-light text-teal1 rounded-circle d-flex align-items-center justify-content-center ml-3 mr-1" style="width: 35px; height:35px;"><i class="fas fa-book fa-lg"></i></a>
                </div>
                {{-- picture bookshelf button (toggle) --}}
                <div class="d-block d-md-none">
                    <a href="" title="絵本棚" class="nav-link">絵本棚</a>
                </div>
            </li>

            {{-- timeline button --}}
            <li class="nav-item d-flex align-items-center justify-content-center">
                <div class="d-none d-md-block">
                    <a href="" title="タイムライン" class="nav-link btn-light text-teal1 rounded-circle d-flex align-items-center justify-content-center mx-1" style="width: 35px; height:35px;"><i class="far fa-clock fa-lg"></i></a>
                </div>
                {{-- timeline button (toggle) --}}
                <div class="d-block d-md-none">
                    <a href="" title="タイムライン" class="nav-link">タイムライン</a>
                </div>
            </li>

            {{-- setting profile button --}}
            <li class="nav-item d-flex align-items-center justify-content-center">
                <div class="d-none d-md-block">
                    <a href="" title="プロフィール設定" class="nav-link btn-light text-teal1 rounded-circle d-flex align-items-center justify-content-center mx-1" style="width: 35px; height:35px;"><i class="fas fa-cog fa-lg"></i></a>
                </div>
                {{-- setting profile button (toggle) --}}
                <div class="d-block d-md-none">
                    <a href="" title="プロフィール設定" class="nav-link">プロフィール設定</a>
                </div>
            </li>

            {{-- profile image(home, logout) button --}}
            <li class="nav-item d-flex align-items-center justify-content-center">
                <div class="d-none d-md-block">
                    <div class="mx-2">
                        <div class="dropdown drop-hover">
                            <a href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="far fa-user-circle fa-2x text-white rounded-circle"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item small" href="../bookshelf.php">ホーム</a>
                                {{-- logout button 1/2 --}}
                                <button form="logout-button" class="dropdown-item small">ログアウト</button>
                            </div>

                            <style>
                                .drop-hover:hover>.dropdown-menu {
                                    display: block;
                                }
                            </style>
                        </div>
                    </div>
                </div>
                {{-- home button (toggle) --}}
                <div class="d-block d-md-none">
                    <a href="" title="ホーム" class="nav-link">ホーム</a>
                </div>
            </li>
            {{-- logout button 2/2 --}}
            <form id="logout-button" method="POST" action="{{ route('logout') }}">
                @csrf
            </form>
            {{-- logout button (toggle) --}}
            <li class="nav-item d-flex align-items-center justify-content-center">
                <div class="d-block d-md-none">
                    <form method="POST" name="form1" action="{{ route('logout') }}">
                        @csrf
                        <a href="javascript:form1.submit()" class="nav-link">ログアウト</a>
                    </form>
                </div>
            </li>
            @endauth
            @guest
            <li class="nav-item">
                <a href="" class="card-title text-decoration-none text-white small ml-3" role="button"><b>よんでとは</b></a>
            </li>

            {{-- register user button --}}
            <li class="nav-item">
                <div class="d-none d-md-block">
                    <a href="{{ route('register') }}" class="btn btn-sm shadow-sm bg-warning text-decoration-none text-white font-weight-bold mx-2" role="button">新規登録</a>
                </div>
                {{-- register user button (toggle) --}}
                <div class="d-block d-md-none">
                    <a href="{{ route('register') }}" class="btn btn-sm btn-block bg-warning text-decoration-none text-white font-weight-bold">新規登録</a>
                </div>
            </li>

            {{-- login user button --}}
            <li class="nav-item">
                <div class="d-none d-md-block">
                    <a href="{{ route('login') }}" class="btn btn-sm shadow-sm btn-outline-teal1 bg-white text-decoration-none text-teal1 font-weight-bold mx-2" role="button" disabled>ログイン</a>
                </div>
            </li>
            {{-- login user button (toggle) --}}
            <div class="d-block d-md-none">
                <a href="{{ route('login') }}" class="btn btn-sm btn-block btn-outline-teal1 bg-white text-decoration-none text-teal1 font-weight-bold">ログイン</a>
            </div>
            @endguest
        </ul>
    </div>
</nav>
