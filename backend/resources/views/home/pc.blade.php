<div class="py-4" style="background:url(image/home_top_pc.jpg) center no-repeat; background-size: cover;">
    <div class="container py-4">
        <div class="row">
            <div class="col-5"></div>
            <div class="col-7 rounded p-2" style="background:rgba(255,255,255,0.6);">
                <h2 class="d-none d-xl-block pl-3 pr-1 pt-4 pb-2 mt-4 text-shadow">
                    <p class="pt-4 mb-1">こどもの「よんで」に</p>
                    <p> いつでもこたえてあげる気持ちになる</p>
                </h2>
                <h3 class="d-none d-lg-block d-xl-none px-2 pt-4 pb-2 mt-4 text-shadow">
                    こどもの「よんで」に<br>
                    いつでもこたえてあげる気持ちになる
                </h3>
                <h5 class="d-none d-md-block d-lg-none pt-4 text-shadow">
                    こどもの「よんで」に<br>
                    いつでもこたえてあげる気持ちになる
                </h5>
                @guest
                <div class="d-flex justify-content-center">
                    <a href="{{ route('register') }}"
                        class="btn btn-lg btn-warning text-white mb-4 shadow-sm rounded-pill text-shadow">
                        <span class="px-4">本棚をつくる</span>
                    </a>
                </div>
                @endguest
                @auth
                <div class="d-flex justify-content-center px-auto">
                    <a href="{{ route('families.bookshelf', ['name' => Auth::user()->family->name]) }}"
                        class="btn btn-teal1 btn-lg mb-4 shadow rounded-pill text-shadow">
                        <span class="px-4 mx-4">本棚をみる</span>
                    </a>
                </div>
                @endauth
            </div>
        </div>
    </div>
</div>

@guest
<div class="container-lg">
    <div style="margin-top: 60px; margin-bottom: 60px;">
        <div class="text-center my-5 text-dark">
            <h1><b>よんで</b>とは</h1>
            <p class="mt-3">
                <b>「よんで」は、Webで本棚をかんたんに作成したり、絵本読み聞かせをしたときに記録して、<br>
                    いつでも記録を見返すことができるサービスです。</b>
            </p>
        </div>
    </div>

    <div class="mt-4">
        <div class="card-deck row no-gutters">
            <div class="col-4">
                <div class="card border-0 p-4">
                    <img src="{{ asset('image/index_3-1.png') }}" width="100%" alt="">
                    <div class="card-body p-0 text-secondary">
                        <p class="card-title">
                            <b>絵本のWeb本棚</b>
                        </p>
                        <small class="card-text">
                            これから読みたい絵本、これまで読んだ絵本をいれておくことができます。
                        </small>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card border-0 p-4">
                    <img src="{{ asset('image/index_3-2.png') }}" width="100%" alt="">
                    <div class="card-body p-0 text-secondary">
                        <p class="card-title">
                            <b>読み聞かせ記録・管理</b>
                        </p>
                        <small class="card-text">
                            絵本の読み聞かせをした記録をかんたんにつけることができます。
                        </small>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card border-0 p-4">
                    <img src="{{ asset('image/index_3-3-0.png') }}" width="100%" alt="">
                    <img src="{{ asset('image/index_3-3.png') }}" width="100%" alt="">
                    <img src="{{ asset('image/index_3-3-2.png') }}" width="100%" alt="">
                    <div class="card-body p-0 text-secondary">
                        <p class="card-title">
                            <b>家族と共有</b>
                        </p>
                        <small class="card-text">
                            登録した絵本・読み聞かせ記録を家族と共有することができます。
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center pb-2">
        <a href="{{ route('about') }}" class="btn btn-outline-teal1 my-2" role="button" style="border-radius: 24px">
            <span class="mx-4">よんでについて</span>
            <i class="fas fa-chevron-right"></i>
        </a>
    </div>
</div>
@endguest

<div class="container-xl border-top pt-4">
    <h4><b>みんなの新しい絵本</b></h4>
</div>
<div id="carousel-card-1" class="carousel slide pb-4 border-bottom" data-ride="carousel" data-wrap="true"
    style="min-height: 250px">
    <ol class="carousel-indicators">
        <li data-target="#carousel-card-1" data-slide-to="0" class="active bg-teal1"></li>
        <li data-target="#carousel-card-1" data-slide-to="1" class="bg-teal1"></li>
        <li data-target="#carousel-card-1" data-slide-to="2" class="bg-teal1"></li>
    </ol>
    <div class="carousel-inner">

        <div class="px-4 mx-4">
            <div class="carousel-item active">
                <div class="d-flex justify-content-center align-items-end flex-wrap">
                    @foreach($pictureBooksNew as $pictureBook)
                    @if ($loop->iteration === 7)
                    @break
                    @endif

                    @include('home.new_stored_thumbnail')

                    @endforeach
                </div>
            </div>

            <div class="carousel-item">
                <div class="d-flex justify-content-center align-items-end flex-wrap">
                    @foreach($pictureBooksNew as $pictureBook)
                    @if ($loop->iteration === 13)
                    @break
                    @elseif ($loop->iteration >= 7)

                    @include('home.new_stored_thumbnail')

                    @endif
                    @endforeach
                </div>
            </div>

            <div class="carousel-item">
                <div class="d-flex justify-content-center align-items-end flex-wrap">
                    @foreach ($pictureBooksNew as $pictureBook)
                    @if ($loop->iteration === 19)
                    @break
                    @elseif ($loop->iteration >= 13)

                    @include('home.new_stored_thumbnail')

                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carousel-card-1" role="button" data-slide="prev">
        <i class="fas fa-angle-left text-teal1 fa-2x" aria-hidden="true"></i>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-card-1" role="button" data-slide="next">
        <i class="fas fa-angle-right text-teal1 fa-2x" aria-hidden="true"></i>
        <span class="sr-only">Next</span>
    </a>
</div>

<div class="container-xl">
    <div class="row">
        <div class="col-8 pr-0">
            <div class="pt-4">
                <h4><b>よんでランキング</b></h4>
                <h5 class="text-secondary">本棚への登録数ランキング</h5>
            </div>
            <div class="row">
                @foreach($storedCountRanking as $pictureBook)
                <div class="col-3">

                    @include('home.pc_ranking_thumbnail')

                    <p class="badge badge-light font-weight-light shadow-sm">
                        登録数
                        {{ $pictureBook->stored_count }}
                    </p>
                </div>
                @endforeach
            </div>


            <div class="pt-4 border-top">
                <h5 class="text-secondary">読み聞かせ記録数ランキング</h5>
            </div>
            <div class="row">
                @foreach($readRecordRanking as $pictureBook)
                <div class="col-3">

                    @include('home.pc_ranking_thumbnail')

                    <p class="badge badge-light font-weight-light shadow-sm">
                        記録数
                        {{ $pictureBook->read_records_count }}
                    </p>
                </div>
                @endforeach
            </div>
        </div>

        <div class="col-4">
            @guest
            <div class="card mt-4 mx-2 mb-2">
                <div class="card-body">
                    <p class="card-title"><b>「よんで」をはじめよう</b></p>
                    <a href="{{ route('register') }}"
                        class="btn btn-block btn-sm btn-warning text-decoration-none text-white my-2"><b>新規登録</b></a>

                    <p class="card-title text-center my-2"><b>または</b></p>
                    <a href="{{ route('login.{provider}', ['provider' => 'google']) }}"
                        class="btn btn-block btn-sm btn-outline-danger my-2">
                        <b>Googleで登録</b>
                    </a>

                    <a href="{{ route('login.guest') }}" class="btn btn-block btn-sm btn-outline-mocha my-2">
                        <b>ゲストログイン</b>
                    </a>
                </div>
            </div>
            @endguest
            {{-- twitter account --}}
            <div class="mt-4 mx-2">
                <p class="mb-0">かんりにんのつぶやき</p>
            </div>
            <div class="card mx-2 mb-2">
                <a class="twitter-timeline" data-lang="ja" data-height="400" data-theme="light"
                    href="https://twitter.com/r_yamate?ref_src=twsrc%5Etfw">Tweets by r_yamate</a>
                <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
            </div>
            {{-- ad --}}
            <div class="card mt-4 mx-2 mb-2">
                <a href="https://pc.moppy.jp/entry/invite.php?invite=xRJKe1c5&type=service"><img
                        src="https://img.moppy.jp/pub/pc/friend/300x250-11.jpg" width="100%"
                        alt="手出しゼロで利用できる♪話題のポイ活始めるならモッピー！"></a>
            </div>
        </div>
    </div>
</div>
