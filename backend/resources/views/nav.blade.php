<nav class="navbar navbar-expand-sm navbar-light bg-teal1 shadow-sm bd-navbar" style="vertical-align: middle; position: sticky; top: 0; z-index: 1071; background: linear-gradient(-135deg, #26a69a, #a1c4fd) fixed; opacity: 0.97;">

        {{-- left: application logo --}}
        <a class="navbar-brand mt-1 mr-2" href="/">
            <img src="image/logo.png" height="35" class="d-inline-block align-top text-white text-decoration-none" alt=" yonde">
        </a>

        {{-- toggle button --}}
        <button class="navbar-toggler p-1" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            {{-- left: application name --}}
            <ul class="navbar-nav mr-auto d-none d-sm-block">
                <li class="nav-item">
                    <a class="nav-link text-white text-decoration-none mb-0 h4" href="/">よんで</a>
                </li>
            </ul>

            {{-- right: --}}
            <ul class="navbar-nav">

                {{-- search bar --}}
                <div class="d-none d-sm-block pt-2">
                    <form action="" method="POST" class="form-inline">
                        <div class="input-group input-group-sm">
                            <input type="search" id="search" name="search" class="form-control" placeholder="絵本をさがす">
                            <div class="input-group-append">
                                <button class="btn btn-outline-teal1 bg-white text-teal1" type="submit" id="search"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                {{-- search bar (toggle) --}}
                <div class="d-block d-sm-none pt-2">
                    <form action="" method="POST" class="form-inline">
                        <div class="input-group input-group-sm">
                            <input type="search" id="search" name="search" class="form-control" placeholder="絵本をさがす">
                            <div class="input-group-append">
                                <button class="btn btn-outline-teal1 bg-white text-teal1" type="submit" id="search"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- picture bookshelf button --}}
                <li class="nav-item">
                    <div class="d-none d-sm-block">
                        <a href="" title="絵本棚" class="nav-link btn-teal1 text-white rounded-circle d-flex align-items-center justify-content-center ml-3" style="width: 45px; height:45px;"><i class="fas fa-book fa-lg"></i></a>
                    </div>
                    {{-- picture bookshelf button (toggle) --}}
                    <div class="d-block d-sm-none">
                        <a href="" title="絵本棚" class="nav-link">絵本棚</a>
                    </div>
                </li>

                {{-- timeline button --}}
                <li class="nav-item">
                    <div class="d-none d-sm-block">
                        <a href="" title="タイムライン" class="nav-link btn-teal1 text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height:45px;"><i class="far fa-clock fa-lg"></i></a>
                    </div>
                    {{-- timeline button (toggle) --}}
                    <div class="d-block d-sm-none">
                        <a href="" title="タイムライン" class="nav-link">タイムライン</a>
                    </div>
                </li>

                {{-- setting profile button --}}
                <li class="nav-item">
                    <div class="d-none d-sm-block">
                        <a href="" title="プロフィール設定" class="nav-link btn-teal1 text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height:45px;"><i class="fas fa-cog fa-lg"></i></a>
                    </div>
                    {{-- setting profile button (toggle) --}}
                    <div class="d-block d-sm-none">
                        <a href="" title="プロフィール設定" class="nav-link">プロフィール設定</a>
                    </div>
                </li>

                {{-- profile image(home, logout) button --}}
                <li class="nav-item">
                    <div class="d-none d-sm-block">
                        <div class="mt-1 ml-1 mr-2">
                            <div class="dropdown drop-hover">
                                <a href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="far fa-user-circle fa-2x text-white rounded-circle"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item small" href="../bookshelf.php">ホーム</a>
                                    <a class="dropdown-item small" href="../auth/logout.php">ログアウト</a>
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
                    <div class="d-block d-sm-none">
                        <a href="" title="ホーム" class="nav-link">ホーム</a>
                    </div>
                </li>
                {{-- logout button (toggle) --}}
                <li class="nav-item">
                    <div class="d-block d-sm-none">
                        <a href="../auth/logout.php" title="ログアウト" class="nav-link">ログアウト</a>
                    </div>
                </li>

            </ul>
        </div>
    </nav>
