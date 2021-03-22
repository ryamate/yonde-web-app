@extends('app')

@section('title', 'よんで-Yonde-')

@section('content')

@include('nav')

<div id="carousel-1" class="carousel slide" data-ride="carousel" data-interval="6000">
    <ol class="carousel-indicators">
        <li data-target="#carousel-1" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-1" data-slide-to="1"></li>
        <li data-target="#carousel-1" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item carousel-responsive active">
            <a href="{{ route('register') }}">
                <img src="{{ asset('image/carousel-register.jpg') }}" class="d-block img-fluid" alt=" ">
            </a>
        </div>
        <div class="carousel-item carousel-responsive">
            <a class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="400"
                href="{{ route('register') }}">
                <img src="{{ asset('image/carousel-register.jpg') }}" class="d-block img-fluid" alt=" ">
            </a>
        </div>
        <div class="carousel-item carousel-responsive">
            <a class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="400"
                href="{{ route('register') }}">
                <img src="{{ asset('image/carousel-register.jpg') }}" class="d-block img-fluid" alt=" ">
            </a>
        </div>
    </div>
    <a class="carousel-control-prev carousel-control-prev-teal" href="#carousel-1" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next carousel-control-next-teal" href="#carousel-1" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>


<div class="container">
    {{-- pc --}}
    <div class="d-none d-md-block">
        <div class="text-center my-4 text-dark">
            <h2><b>よんで</b>とは</h2>
            <p><b>「よんで」は、Webで本棚をかんたんに作成したり、絵本読み聞かせをしたときに記録・管理し、<br>こどもが成長したとき、アルバムのように、みかえすことができます。</b></p>
        </div>
    </div>
    {{-- smart phone --}}
    <div class="d-block d-md-none">
        <div class="text-left my-4 text-dark">
            <h5><b>よんで</b>とは</h5>
            <small><b>　「よんで」は、Webで本棚をかんたんに作成したり、絵本読み聞かせをしたときに記録・管理し、<br>こどもが成長したとき、アルバムのように、みかえすことができます。</b></small>
        </div>
    </div>

    <div class="mt-4">
        {{-- pc --}}
        <div class="d-none d-md-block">
            <div class="card-deck row no-gutters">
                <div class="col-md-4">
                    <div class="card border-0 p-4">
                        <img src="{{ asset('image/index_3-1.png') }}" width="100%" alt="">
                        <div class="card-body p-0 text-secondary">
                            <p class="card-title"><b>絵本棚</b></p>
                            <small class="card-text">これからよみたい絵本、これまでよんだ絵本をいれることができます。</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 p-4">
                        <img src="{{ asset('image/index_3-2.png') }}" width="100%" alt="">
                        <div class="card-body p-0 text-secondary">
                            <p class="card-title"><b>読み聞かせの記録・管理</b></p>
                            <small class="card-text">絵本の読み聞かせをした記録を付けることができます。</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 p-4">
                        <img src="{{ asset('image/index_3-3-0.png') }}" width="100%" alt="">
                        <img src="{{ asset('image/index_3-3.png') }}" width="100%" alt="">
                        <img src="{{ asset('image/index_3-3-2.png') }}" width="100%" alt="">
                        <div class="card-body p-0 text-secondary">
                            <p class="card-title"><b>家族と共有</b></p>
                            <small class="card-text">絵本棚・読み聞かせ記録を家族と共有することができます。</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- smart phone --}}
        <div class="d-block d-md-none">
            <div class="card mb-2">
                <div class="card-body shadow">
                    <div class="row no-gutters">
                        <div class="col-6 pr-3">
                            <img src="{{ asset('image/index_3-1.png') }}" width="100%" alt="">
                        </div>
                        <div class="col-6 d-flex align-items-center border-left">
                            <div class="card-body pr-0">
                                <p class="card-title small"><b>絵本棚</b></p>
                                <p class="card-text small">これからよみたい絵本、これまでよんだ絵本をいれることができます。</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-2">
                <div class="card-body shadow">
                    <div class="row no-gutters">
                        <div class="col-6 pr-3">
                            <div class="card-body pl-0">
                                <p class="card-title small"><b>読み聞かせの記録・管理</b></p>
                                <p class="card-text small">絵本の読み聞かせをした記録を付けることができます。</p>
                            </div>
                        </div>
                        <div class="col-6 d-flex align-items-center border-left pl-3">
                            <img src="{{ asset('image/index_3-2.png') }}" width="100%" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-2">
                <div class="card-body shadow">
                    <div class="row no-gutters">
                        <div class="col-6 pr-3">
                            <img src="{{ asset('image/index_3-3-0.png') }}" width="100%" alt="">
                            <img src="{{ asset('image/index_3-3.png') }}" width="100%" alt="">
                            <img src="{{ asset('image/index_3-3-2.png') }}" width="100%" alt="">
                        </div>
                        <div class="col-6 d-flex align-items-center border-left">
                            <div class="card-body pr-0">
                                <p class="card-title small"><b>家族と共有</b></p>
                                <p class="card-text small">絵本棚・読み聞かせ記録を家族と共有することができます。</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- pc --}}
<div class="text-center d-none d-md-block border-bottom pb-4 mx-5">
    <a href="" class="btn btn-outline-teal1 mt-2 mb-2" role="button" style="border-radius: 24px">　　　よんでについて　　<i
            class="fas fa-chevron-right"></i></a>
</div>
{{-- smart phone --}}
<div class="container">
    <div class="text-center d-block d-md-none border-bottom py-4">
        <a href="" class="btn btn-block btn-outline-teal1 mt-2 mb-2 rounded-pill" role="button">　　　よんでについて　　<i
                class="fas fa-chevron-right"></i></a>
    </div>
</div>

<div class="container pt-4">
    <h4><b>タイムラインの新しい絵本</b></h4>
</div>
<div id="carousel-card" class="carousel slide" data-ride="false" data-wrap="false">
    <div class="carousel-inner">
        <div class="carousel-item active" style="padding-right: 70px; padding-left: 70px;">
            <div class="row">
                @foreach($stored_picture_books as $stored_picture_book)
                @if ($loop->iteration === 7)
                @break
                @endif
                <div class="col-md-2 col-6">
                    <div class="card border-0 py-0">
                        <div class="card-img-top book-cover my-auto">
                            @if ($stored_picture_book->pictureBook->thumbnail_uri !== null)
                            <img src="{{ $stored_picture_book->pictureBook->thumbnail_uri }}" alt="book-cover"
                                class="book-cover-image">
                            @else
                            <img src="{{ asset('image/no_image.png') }}" alt="No Image" class="book-cover-image">
                            @endif
                        </div>
                        <div class="card-body px-0">
                            <a href="{{ route('picture_books.show', ['stored_picture_book' => $stored_picture_book]) }}"
                                class="card-title text-dark small"><b>{{ $stored_picture_book->pictureBook->title }}</b></a><br>
                            <a href="" class="card-text text-teal1 small">
                                @if ($stored_picture_book->pictureBook->authors !== null)
                                {{ $stored_picture_book->pictureBook->authors }}
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="carousel-item" style="padding-right: 70px; padding-left: 70px;">
            <div class="row">
                @foreach($stored_picture_books as $stored_picture_book)
                @if ($loop->iteration === 7)
                <div class="col-md-2 col-6">
                    <div class="card border-0 py-0">
                        <div class="card-img-top book-cover my-auto">
                            @if ($stored_picture_book->pictureBook->thumbnail_uri !== null)
                            <img src="{{ $stored_picture_book->pictureBook->thumbnail_uri }}" alt="book-cover"
                                class="book-cover-image">
                            @else
                            <img src="{{ asset('image/no_image.png') }}" alt="No Image" class="book-cover-image">
                            @endif
                        </div>
                        <div class="card-body px-0">
                            <a href="{{ route('picture_books.show', ['stored_picture_book' => $stored_picture_book]) }}"
                                class="card-title text-dark small"><b>{{ $stored_picture_book->pictureBook->title }}</b></a><br>
                            <a href="" class="card-text text-teal1 small">
                                @if ($stored_picture_book->pictureBook->authors !== null)
                                {{ $stored_picture_book->pictureBook->authors }}
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
                @elseif ($loop->iteration === 13)
                @break
                @endif
                @endforeach
            </div>
        </div>
        <div class="carousel-item" style="padding-right: 70px; padding-left: 70px;">
            <div class="row">
                @foreach($stored_picture_books as $stored_picture_book)
                @if ($loop->iteration === 13)
                <div class="col-md-2 col-6">
                    <div class="card border-0 py-0">
                        <div class="card-img-top book-cover my-auto">
                            @if ($stored_picture_book->pictureBook->thumbnail_uri !== null)
                            <img src="{{ $stored_picture_book->pictureBook->thumbnail_uri }}" alt="book-cover"
                                class="book-cover-image">
                            @else
                            <img src="{{ asset('image/no_image.png') }}" alt="No Image" class="book-cover-image">
                            @endif
                        </div>
                        <div class="card-body px-0">
                            <a href="{{ route('picture_books.show', ['stored_picture_book' => $stored_picture_book]) }}"
                                class="card-title text-dark small"><b>{{ $stored_picture_book->pictureBook->title }}</b></a><br>
                            <a href="" class="card-text text-teal1 small">
                                @if ($stored_picture_book->pictureBook->authors !== null)
                                {{ $stored_picture_book->pictureBook->authors }}
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
                @elseif ($loop->iteration === 19)
                @break
                @endif
                @endforeach
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carousel-card" role="button" data-slide="prev">
        <i class="fas fa-arrow-circle-left text-teal1 fa-2x" aria-hidden="true"></i>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-card" role="button" data-slide="next">
        <i class="fas fa-arrow-circle-right text-teal1 fa-2x" aria-hidden="true"></i>
        <span class="sr-only">Next</span>
    </a>
    <div class="pb-4 border-bottom"></div>
</div>



<div class="row">
    <div class="col-md-8 pr-0">
        <div class="container pt-4">
            <h4><b>よんでランキング</b></h4>
            <h5 class="text-secondary">絵本棚登録数</h5>
        </div>
        <div id="carousel-card-2" class="carousel slide" data-ride="false" data-wrap="false">
            <div class="carousel-inner">
                <div class="carousel-item active" style="padding-right: 70px; padding-left: 70px;">
                    <div class="row">
                        @foreach($stored_picture_books as $stored_picture_book)
                        @if ($loop->iteration === 5)
                        @break
                        @endif
                        <div class="col-md-3 col-6">
                            <div class="card border-0 py-0">
                                <div class="card-img-top book-cover my-auto">
                                    @if ($stored_picture_book->pictureBook->thumbnail_uri !== null)
                                    <img src="{{ $stored_picture_book->pictureBook->thumbnail_uri }}" alt="book-cover"
                                        class="book-cover-image">
                                    @else
                                    <img src="{{ asset('image/no_image.png') }}" alt="No Image"
                                        class="book-cover-image">
                                    @endif
                                </div>
                                <div class="card-body px-0">
                                    <a href="{{ route('picture_books.show', ['stored_picture_book' => $stored_picture_book]) }}"
                                        class="card-title text-dark small"><b>{{ $stored_picture_book->pictureBook->title }}</b></a><br>
                                    <a href="" class="card-text text-teal1 small">
                                        @if ($stored_picture_book->pictureBook->authors !== null)
                                        {{ $stored_picture_book->pictureBook->authors }}
                                        @endif
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="carousel-item" style="padding-right: 70px; padding-left: 70px;">
                    <div class="row">
                        @foreach($stored_picture_books as $stored_picture_book)
                        @if ($loop->iteration === 5)
                        <div class="col-md-2 col-6">
                            <div class="card border-0 py-0">
                                <div class="card-img-top book-cover my-auto">
                                    @if ($stored_picture_book->pictureBook->thumbnail_uri !== null)
                                    <img src="{{ $stored_picture_book->pictureBook->thumbnail_uri }}" alt="book-cover"
                                        class="book-cover-image">
                                    @else
                                    <img src="{{ asset('image/no_image.png') }}" alt="No Image"
                                        class="book-cover-image">
                                    @endif
                                </div>
                                <div class="card-body px-0">
                                    <a href="{{ route('picture_books.show', ['stored_picture_book' => $stored_picture_book]) }}"
                                        class="card-title text-dark small"><b>{{ $stored_picture_book->pictureBook->title }}</b></a><br>
                                    <a href="" class="card-text text-teal1 small">
                                        @if ($stored_picture_book->pictureBook->authors !== null)
                                        {{ $stored_picture_book->pictureBook->authors }}
                                        @endif
                                    </a>
                                </div>
                            </div>
                        </div>
                        @elseif ($loop->iteration === 9)
                        @break
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carousel-card-2" role="button" data-slide="prev">
                <i class="fas fa-arrow-circle-left text-teal1 fa-2x" aria-hidden="true"></i>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel-card-2" role="button" data-slide="next">
                <i class="fas fa-arrow-circle-right text-teal1 fa-2x" aria-hidden="true"></i>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="container pt-4 border-top">
            <h5 class="text-secondary">読み聞かせ回数</h5>
        </div>
        <div id="carousel-card-2" class="carousel slide" data-ride="false" data-wrap="false">
            <div class="carousel-inner">
                <div class="carousel-item active" style="padding-right: 70px; padding-left: 70px;">
                    <div class="row">
                        @foreach($stored_picture_books as $stored_picture_book)
                        @if ($loop->iteration === 5)
                        @break
                        @endif
                        <div class="col-md-3 col-6">
                            <div class="card border-0 py-0">
                                <div class="card-img-top book-cover my-auto">
                                    @if ($stored_picture_book->pictureBook->thumbnail_uri !== null)
                                    <img src="{{ $stored_picture_book->pictureBook->thumbnail_uri }}" alt="book-cover"
                                        class="book-cover-image">
                                    @else
                                    <img src="{{ asset('image/no_image.png') }}" alt="No Image"
                                        class="book-cover-image">
                                    @endif
                                </div>
                                <div class="card-body px-0">
                                    <a href="{{ route('picture_books.show', ['stored_picture_book' => $stored_picture_book]) }}"
                                        class="card-title text-dark small"><b>{{ $stored_picture_book->pictureBook->title }}</b></a><br>
                                    <a href="" class="card-text text-teal1 small">
                                        @if ($stored_picture_book->pictureBook->authors !== null)
                                        {{ $stored_picture_book->pictureBook->authors }}
                                        @endif
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="carousel-item" style="padding-right: 70px; padding-left: 70px;">
                    <div class="row">
                        @foreach($stored_picture_books as $stored_picture_book)
                        @if ($loop->iteration === 5)
                        <div class="col-md-3 col-6">
                            <div class="card border-0 py-0">
                                <div class="card-img-top book-cover my-auto">
                                    @if ($stored_picture_book->pictureBook->thumbnail_uri !== null)
                                    <img src="{{ $stored_picture_book->pictureBook->thumbnail_uri }}" alt="book-cover"
                                        class="book-cover-image">
                                    @else
                                    <img src="{{ asset('image/no_image.png') }}" alt="No Image"
                                        class="book-cover-image">
                                    @endif
                                </div>
                                <div class="card-body px-0">
                                    <a href="{{ route('picture_books.show', ['stored_picture_book' => $stored_picture_book]) }}"
                                        class="card-title text-dark small"><b>{{ $stored_picture_book->pictureBook->title }}</b></a><br>
                                    <a href="" class="card-text text-teal1 small">
                                        @if ($stored_picture_book->pictureBook->authors !== null)
                                        {{ $stored_picture_book->pictureBook->authors }}
                                        @endif
                                    </a>
                                </div>
                            </div>
                        </div>
                        @elseif ($loop->iteration === 9)
                        @break
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carousel-card-2" role="button" data-slide="prev">
                <i class="fas fa-arrow-circle-left text-teal1 fa-2x" aria-hidden="true"></i>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel-card-2" role="button" data-slide="next">
                <i class="fas fa-arrow-circle-right text-teal1 fa-2x" aria-hidden="true"></i>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <div class="col-md-4 mt-4 px-4">
        <div class="card mt-4 mx-2 mb-2">
            <div class="card-body">
                <p class="card-title">「よんで」をはじめよう</p>
                <a href="{{ route('register') }}"
                    class="btn btn-block btn-sm btn-warning text-decoration-none text-white"><b>新規登録</b></a>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <p class="card-title">または</p>
                    <button type="submit"
                        class="btn btn-block btn-sm bg-white btn-outline-secondary text-decoration-none text-secondary"><b>ゲストユーザーログイン</b></button>
                </form>
            </div>
        </div>
        {{-- ダミー --}}
        <div class="card mt-4 mx-2 mb-2">
            <a class="twitter-timeline" data-lang="ja" data-height="400" data-theme="light"
                href="https://twitter.com/r_yamate?ref_src=twsrc%5Etfw">Tweets by r_yamate</a>
            <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
        </div>
    </div>
</div>
@include('footer')

@endsection
