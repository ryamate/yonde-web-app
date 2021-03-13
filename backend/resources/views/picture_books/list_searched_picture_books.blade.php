@extends('app')

@section('title', '絵本検索結果-Yonde-')

@section('content')

@include('nav')

<header>
    <div class="bg-light">
        <div class="container" style="padding-bottom:60px; max-width: 900px;">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-light small pl-0 mb-0">
                    @if ($items === null)
                    <li class="breadcrumb-item"><a href="/" class="text-teal1">よんで</a></li>
                    <li class="breadcrumb-item active" aria-current="page">絵本検索</li>
                    @else
                    <li class="breadcrumb-item"><a href="/" class="text-teal1">よんで</a></li>
                    <li class="breadcrumb-item"><a href="/search" class="text-teal1">絵本検索</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $keyword }}</li>
                    @endif
                </ol>
            </nav>
            <h2>絵本の検索</h2>
            @if ($items === null)
            <div class="alert alert-teal1" style="max-width: 360px;">
                <p>書籍名を入力してください。</p>
            </div>
            @endif
            <p>まずは絵本のタイトル、作家名、出版社名などを入力して検索してください。</p>
            <p>例えば… パンやのろくちゃん や はらぺこあおむし など。</p>
            <form action="{{ route('search') }}" method="GET" class="form-inline">
                @csrf
                <div class="input-group">
                    <input type="text" id="search" name="keyword" class="form-control border" placeholder="絵本をさがす"
                        value="{{ $keyword }}">
                    <div class="input-group-append">
                        <button class="btn border bg-white text-teal1" type="submit" id="search"><i
                                class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</header>

<div class="bg-light">
    <div class="container">
        <div class="row">
            <div class="container" style="max-width: 900px;">
                @if ($items !== null)
                <h3>検索結果</h3>
                <section class="card shadow-sm mb-4">
                    @foreach ($items as $item)
                    <div class="card-body border-bottom p-0">
                        <div class="row no-gutters">
                            {{-- サムネイル --}}
                            <div class="col-sm-3">
                                <div class="card-body py-0">
                                    <div class="book-cover">
                                        @if (array_key_exists('imageLinks', $item['volumeInfo']))
                                        <img src="{{ $item['volumeInfo']['imageLinks']['thumbnail'] }}" alt="book-cover"
                                            class="book-cover-image">
                                        @else
                                        <img src="image/no_image.png" alt="No Image" class="book-cover-image">
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- タイトル, 登録者数/評価/レビュー, 作者/出版年月 --}}
                            <div class="col-sm-6 d-flex align-items-center">
                                <div class="card-body">
                                    <a href=""
                                        class="card-title text-teal1 h5"><b>{{ $item['volumeInfo']['title'] }}</b></a>
                                    {{-- ダミー値 --}}
                                    <div class="card-text small mt-2">
                                        <p>
                                            <i class="fas fa-user"></i>123人 <i class="fas fa-star"></i>4.56 <i
                                                class="fas fa-pen"></i>78件
                                        </p>
                                    </div>
                                    <div class="card-text small">
                                        <p>
                                            @if (array_key_exists('authors', $item['volumeInfo']))
                                            {{ $item['volumeInfo']['authors'][0] }}/
                                            @endif
                                            @if (array_key_exists('publishedDate', $item['volumeInfo']))
                                            {{ $item['volumeInfo']['publishedDate'] }}出版
                                            @endif
                                        </p>
                                    </div>

                                </div>
                            </div>
                            <!-- 登録ボタン -->
                            <div class="col-sm-3 d-flex align-items-center">
                                <div class="card-body">
                                    @auth
                                    <form action="{{ route('picture_books.create') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn btn-teal1 shadow-sm btn-block"><i
                                                class="fas fa-plus-circle"></i> 本棚に登録</button>
                                        <input type="hidden" name="google_books_id" value="{{ $item['id'] }}" />
                                        <input type="hidden" name="isbn_13"
                                            value="{{ $item['volumeInfo']['industryIdentifiers'][1]['identifier'] }}" />
                                        <input type="hidden" name="title" value="{{ $item['volumeInfo']['title'] }}" />
                                        <input type="hidden" name="authors"
                                            value="{{ $item['volumeInfo']['authors'][0] }}" />
                                        <input type="hidden" name="published_date"
                                            value="{{ $item['volumeInfo']['publishedDate'] }}" />
                                        <input type="hidden" name="thumbnail_uri"
                                            value="{{ $item['volumeInfo']['imageLinks']['thumbnail'] }}" />
                                    </form>
                                    @endauth
                                    @guest
                                    <form action="" method="POST">
                                        <button type="submit"
                                            class="btn btn btn-outline-teal1 bg-white text-teal1 shadow-sm btn-block">レビューを読む</button>
                                    </form>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </section>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
