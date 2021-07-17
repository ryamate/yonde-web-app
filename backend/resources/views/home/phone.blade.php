<div class="py-2" style="background:url(image/home_top_phone.jpg) center no-repeat; background-size: cover;">
    <div class="container py-2">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-8 rounded py-2" style="background:rgba(255,255,255,0.7);">
                <h5 class="d-none d-sm-block pt-2 mb-1 text-center text-shadow">
                    こどもの「よんで」に<br>
                    いつでもこたえてあげる<br>
                    気持ちになる
                </h5>
                <p class="d-block d-sm-none pt-1 mb-1 text-center text-shadow" style="font-size: 14px">
                    こどもの「よんで」に<br>
                    いつでもこたえてあげる<br>
                    気持ちになる
                </p>
                @guest
                <div class="d-flex justify-content-center">
                    <a href="{{ route('register') }}"
                        class="btn btn-block btn-warning btn-sm text-white mb-2 shadow-sm rounded-pill text-shadow">
                        <span>本棚をつくる</span>
                    </a>
                </div>
                @endguest
                @auth
                <div class="d-flex justify-content-center px-auto">
                    <a href="{{ route('families.bookshelf', ['name' => Auth::user()->family->name]) }}"
                        class="btn btn-block btn-teal1 mb-2 shadow rounded-pill text-shadow">
                        <span>本棚をみる</span>
                    </a>
                </div>
                @endauth
            </div>
        </div>
    </div>
</div>

@guest
<div class="container-lg">
    {{-- smart phone --}}
    <div class="my-4 text-dark">
        <h3 class="text-center">
            <b>よんで</b>とは
        </h3>
        <small>
            <b>　「よんで」は、Web上の本棚をかんたんに作成したり、絵本読み聞かせをしたときに記録して、いつでも記録を見返すことができるサービスです。</b>
        </small>
    </div>

    <div class="mt-4">
        <div class="card mb-2">
            <div class="card-body shadow-lg">
                <div class="row no-gutters">
                    <div class="col-6 pr-3">
                        <img src="{{ asset('image/index_3-1.png') }}" class="d-block mx-auto" width="80%" alt="">
                        <p class="card-title small text-center mb-0">
                            <b>絵本のWeb本棚</b>
                        </p>
                    </div>
                    <div class="col-6 d-flex align-items-center border-left">
                        <div class="card-body pr-0">
                            <p class="card-text x-small">
                                これから読みたい絵本、これまで読んだ絵本をいれておくことができます。
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-2">
            <div class="card-body shadow-lg">
                <div class="row no-gutters">
                    <div class="col-6 d-flex align-items-center pr-3">
                        <div class="card-body pl-0">
                            <p class="card-text x-small">
                                絵本の読み聞かせをした記録をかんたんにつけることができます。
                            </p>
                        </div>
                    </div>
                    <div class="col-6 border-left pl-3">
                        <img src="{{ asset('image/index_3-2.png') }}" class="d-block mx-auto" width="80%" alt="">
                        <p class="card-title text-center small mb-0">
                            <b>読み聞かせの<br>
                                記録・管理</b>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-2">
            <div class="card-body shadow-lg">
                <div class="row no-gutters">
                    <div class="col-6 pr-3">
                        <img src="{{ asset('image/index_3-3-0.png') }}" width="80%" alt="">
                        <img src="{{ asset('image/index_3-3.png') }}" class="d-block mx-auto" width="80%" alt="">
                        <img src="{{ asset('image/index_3-3-2.png') }}" width="80%" alt="">
                        <p class="card-title text-center small mb-0">
                            <b>家族と共有</b>
                        </p>
                    </div>
                    <div class="col-6 d-flex align-items-center border-left">
                        <div class="card-body pr-0">
                            <p class="card-text x-small">
                                登録した絵本・読み聞かせ記録を家族と共有することができます。
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="text-center py-4">
        <a href="{{ route('about') }}" class="btn btn-block btn-outline-teal1 mt-2 mb-2 rounded-pill shadow"
            role="button">
            <span class="mx-4">よんでについて</span>
            <i class="fas fa-chevron-right"></i>
        </a>
    </div>
</div>
@endguest

<div class="container-xl border-top pt-4">
    <h5>
        <b>みんなの新しい絵本</b>
    </h5>
</div>
<div id="carousel-card-2" class="carousel slide pb-4 border-bottom" data-ride="carousel" data-wrap="true">
    <ol class="carousel-indicators">
        <li data-target="#carousel-card-2" data-slide-to="0" class="active bg-teal1"></li>
        <li data-target="#carousel-card-2" data-slide-to="1" class="bg-teal1"></li>
        <li data-target="#carousel-card-2" data-slide-to="2" class="bg-teal1"></li>
    </ol>
    <div class="carousel-inner">
        <div class="px-2 mx-2">
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
    <a class="carousel-control-prev" href="#carousel-card-2" role="button" data-slide="prev">
        <i class="fas fa-angle-left text-teal1 fa-2x" aria-hidden="true"></i>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-card-2" role="button" data-slide="next">
        <i class="fas fa-angle-right text-teal1 fa-2x" aria-hidden="true"></i>
        <span class="sr-only">Next</span>
    </a>
</div>

<div class="container-xl">
    <div class="pr-0">
        <div class="pt-4">
            <h5>
                <b>よんでランキング</b>
            </h5>
            <h6 class="text-secondary">
                本棚への登録数ランキング
            </h6>
        </div>
        <div class="container">
            <div class="row">
                @foreach($storedCountRanking as $pictureBook)
                <div class="col-3 mb-1 pl-0">
                    @include('home.phone_ranking_thumbnail')
                </div>
                {{-- tablet --}}
                <div class="d-sm-block d-none col-9 mb-1 pl-0">
                    <div class="card border-0 py-2">
                        <div class="card-body p-0 mt-1">
                            <a href="{{ route('picture_books.show', ['picture_book' => $pictureBook]) }}"
                                class="card-title text-decoration-none">
                                <p class="text-teal1 mb-0">
                                    <b>{{ $pictureBook->title }}</b>
                                </p>
                            </a>
                            <a href="{{ route('picture_books.search', ['keyword' => $pictureBook->authors]) }}"
                                class=" card-text text-decoration-none">
                                @if ($pictureBook->authors !== null)
                                <p class="text-dark mb-0">
                                    {{ $pictureBook->authors }}
                                </p>
                                @endif
                            </a>
                            <p class="badge badge-light font-weight-light shadow-sm mb-0">
                                記録数
                                {{ $pictureBook->stored_count }}
                            </p>
                        </div>
                    </div>
                </div>
                {{-- smart phone --}}
                <div class="d-block d-sm-none col-9 mb-1 pl-0">
                    <div class="card border-0 py-2">
                        <div class="card-body p-0 mt-1">
                            <a href="{{ route('picture_books.show', ['picture_book' => $pictureBook]) }}"
                                class="card-title text-decoration-none">
                                <p class="text-teal1 small mb-0" style="line-height:18px;">
                                    <b>{{ $pictureBook->title }}</b>
                                </p>
                            </a>
                            <a href="{{ route('picture_books.search', ['keyword' => $pictureBook->authors]) }}"
                                class=" card-text text-decoration-none">
                                @if ($pictureBook->authors !== null)
                                <p class="text-dark x-small font-weight-bold mb-0" style="line-height:14px;">
                                    {{ $pictureBook->authors }}
                                </p>
                                @endif
                            </a>
                            <p class="badge badge-light font-weight-light shadow-sm mb-0">
                                登録数
                                {{ $pictureBook->stored_count }}
                            </p>
                        </div>
                    </div>
                </div>

                @endforeach
            </div>
        </div>
        <div class="pt-4 border-top">
            <h6 class="text-secondary">読み聞かせ記録数ランキング</h6>
        </div>
        <div class="container">
            <div class="row">
                @foreach($readRecordRanking as $pictureBook)
                <div class="col-3 mb-1 pl-0">
                    @include('home.phone_ranking_thumbnail')
                </div>
                {{-- tablet --}}
                <div class="d-sm-block d-none col-9 mb-1 pl-0">
                    <div class="card border-0 py-2">
                        <div class="card-body p-0 mt-1">
                            <a href="{{ route('picture_books.show', ['picture_book' => $pictureBook]) }}"
                                class="card-title text-decoration-none">
                                <p class="text-teal1 mb-0">
                                    <b>{{ $pictureBook->title }}</b>
                                </p>
                            </a>
                            <a href="{{ route('picture_books.search', ['keyword' => $pictureBook->authors]) }}"
                                class=" card-text text-decoration-none">
                                @if ($pictureBook->authors !== null)
                                <p class="text-dark mb-0">
                                    {{ $pictureBook->authors }}
                                </p>
                                @endif
                            </a>
                            <p class="badge badge-light font-weight-light shadow-sm mb-0">
                                記録数
                                {{ $pictureBook->read_records_count }}
                            </p>
                        </div>
                    </div>
                </div>
                {{-- smart phone --}}
                <div class="d-block d-sm-none col-9 mb-1 pl-0">
                    <div class="card border-0 py-2">
                        <div class="card-body p-0 mt-1">
                            <a href="{{ route('picture_books.show', ['picture_book' => $pictureBook]) }}"
                                class="card-title text-decoration-none">
                                <p class="text-teal1 small mb-0" style="line-height:18px;">
                                    <b>{{ $pictureBook->title }}</b>
                                </p>
                            </a>
                            <a href="{{ route('picture_books.search', ['keyword' => $pictureBook->authors]) }}"
                                class=" card-text text-decoration-none">
                                @if ($pictureBook->authors !== null)
                                <p class="text-dark x-small font-weight-bold mb-0" style="line-height:14px;">
                                    {{ $pictureBook->authors }}
                                </p>
                                @endif
                            </a>
                            <p class="badge badge-light font-weight-light shadow-sm mb-0">
                                記録数
                                {{ $pictureBook->read_records_count }}
                            </p>
                        </div>
                    </div>
                </div>

                @endforeach
            </div>
        </div>
    </div>

    @guest
    <div class="card mt-4 mx-2 mb-2">
        <div class="card-body">
            <p class="card-title"><b>「よんで」をはじめよう</b></p>
            <a href="{{ route('register') }}"
                class="btn btn-block btn-sm btn-warning text-decoration-none text-white my-2"><b>新規登録</b></a>

            <p class="card-title text-center my-2"><b>または</b></p>
            <a href="{{ route('login.{provider}', ['provider' => 'google']) }}"
                class="btn btn-block btn-sm btn-outline-danger my-2">
                <i class="fab fa-google mr-4"></i><b>Googleで登録</b>
            </a>

            <a href="{{ route('login.guest') }}"
                class="btn btn-block btn-sm bg-white btn-outline-mocha text-mocha my-2">
                <b>ゲストログイン</b>
            </a>
        </div>
    </div>
    @endguest
    {{-- twitter account --}}
    <div class="mt-4 mx-4">
        <p class="mb-0">管理者のTwitter</p>
    </div>
    <div class="card mb-4 mx-4">
        <a class="twitter-timeline" data-lang="ja" data-height="400" data-theme="light"
            href="https://twitter.com/r_yamate?ref_src=twsrc%5Etfw">Tweets by r_yamate</a>
        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    </div>
    {{-- ad --}}
    <div class="card m-4">
        <a href="https://pc.moppy.jp/entry/invite.php?invite=xRJKe1c5&type=service"><img
                src="https://img.moppy.jp/pub/pc/friend/468x60-11.jpg" width="100%"
                alt="手出しゼロで利用できる♪話題のポイ活始めるならモッピー！"></a>
    </div>
</div>
