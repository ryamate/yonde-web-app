@extends('app')

@section('title', '絵本検索結果-よんで-')

@section('content')

@include('nav')

<header>
    <div class="bg-paper">
        <div class="container" style="padding-bottom:60px; max-width: 900px;">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-paper small pl-0 mb-0">
                    @if ($searchedBooks === null)
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-teal1">よんで</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">絵本検索</li>
                    @else
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-teal1">よんで</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('picture_books.search') }}"
                            class="text-teal1">絵本検索</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $keyword }}</li>
                    @endif
                </ol>
            </nav>
            <h2>絵本の検索</h2>
            @if ($searchedBooks === null)
            <div class="alert alert-teal1" style="max-width: 360px;">
                <p>書籍名を入力してください。</p>
            </div>
            @endif
            <p>まずは絵本のタイトル、作家名などを入力して検索してください。</p>
            <p>例えば…
                <a href="{{ route('picture_books.search' , ['keyword' => 'はらぺこあおむし']) }}"
                    class="text-teal1">はらぺこあおむし</a> や <a
                    href="{{ route('picture_books.search' , ['keyword'=> 'エリック・カール']) }}"
                    class="text-teal1">エリック・カール</a>
                など。</p>
            <form action="{{ route('picture_books.search') }}" method="GET" class="form-inline">
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

<div class="bg-paper">
    <div class="container" style="max-width: 900px;">
        @if ($searchedBooks !== null)
        <h3>検索結果</h3>
        <section class="card shadow-sm mb-4">
            @foreach ($searchedBooks as $searchedBook)
            <div class="card-body border-bottom p-0">
                <div class="row no-gutters">
                    {{-- サムネイル --}}
                    <div class="col-md-3 col-sm-4">
                        <div class="card-body py-0">
                            <div class="book-cover">
                                @if (@$searchedBook->imageLinks->thumbnail !== null)
                                <img src="{{ $searchedBook->imageLinks->thumbnail }}" alt="book-cover"
                                    class="book-cover-image">
                                @else
                                <div class="no-image-background book-cover-image">
                                    <div class="no-image-title">
                                        <div class="ml-3 mr-2">
                                            <p class="text-dark text-shadow x-small mb-0" style="line-height:14px;">
                                                {{ $searchedBook->title }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- タイトル, 登録者数/評価/レビュー, 作者/出版年月 --}}
                    <div class="col-md-6 col-sm-8 d-flex align-items-center">
                        <div class="card-body">
                            <p class="card-title h6">
                                <b>{{ @$searchedBook->title }}</b>
                            </p>
                            <div class="card-text small mt-2 mb-2">
                                @if ($searchedBook->stored_count !== 0)
                                <span class="d-flex justify-content-start flex-wrap">
                                    <span class="text-info mx-2" title="登録数">
                                        <i class="fas fa-book"></i>
                                        <b>{{ $searchedBook->stored_count }}</b>
                                    </span>
                                    <span class="text-teal1 mx-2" title="読み聞かせ回数">
                                        <i class="fas fa-book-reader"></i>
                                        <b>{{ $searchedBook->read_records_count }}</b><span class="text-dark">回</span>
                                    </span>
                                    <span class="text-lemon-tea mx-2">
                                        <i class="fas fa-star"></i>
                                        <b>{{ $searchedBook->five_star_avg }}</b>
                                    </span>
                                    <a href="{{ route('picture_books.show', ['picture_book' => $searchedBook->picture_book]) }}"
                                        class="text-info mx-2" title="レビュー件数">
                                        <i class="fas fa-pen"></i>
                                        <b>{{ $searchedBook->review_count }}</b><span class="text-dark">件</span>
                                    </a>
                                </span>
                                @else
                                <span class="d-flex justify-content-start flex-wrap text-muted">
                                    <span class="mx-2" title="登録数">
                                        <i class="fas fa-book mr-1"></i>
                                        {{ $searchedBook->stored_count }}
                                    </span>
                                    <span class="mx-2" title="読み聞かせ回数">
                                        <i class="fas fa-book-reader mr-1"></i> -回
                                    </span>
                                    <span class="mx-2">
                                        <i class="fas fa-star mr-1"></i> -
                                    </span>
                                    <span class="mx-2" title="レビュー件数">
                                        <i class="fas fa-pen mr-1"></i> -件
                                    </span>
                                </span>
                                @endif
                            </div>
                            <div class="card-text font-weight-paper">
                                <p class="mb-1 small">
                                    @if (@$searchedBook->authors !== null)
                                    {{ $searchedBook->authors = implode(",", @$searchedBook->authors) }} /
                                    @else
                                    {{ $searchedBook->authors = null }}
                                    @endif

                                    @if (@$searchedBook->publishedDate !== null)
                                    {{ $searchedBook->publishedDate }}
                                    @endif
                                </p>
                                @if (@$searchedBook->description !== null)
                                <p class="mb-0 small">
                                    {{ $searchedBook->description }}
                                </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- 登録ボタン -->
                    <div class="col-md-3 d-flex align-items-center">
                        <div class="card-body">
                            @auth
                            @if ($family->isStoredBy($searchedBook))
                            <a class="btn btn-sm btn-block btn-outline-teal1 text-teal1 bg-white shadow-sm"
                                href="{{ route("families.show", [
                                            'name' => Auth::user()->family->name,
                                            'picture_book' => $family->pictureBooks->firstWhere('google_books_id', $searchedBook->id)]) }}">
                                <i class="fas fa-book mr-1"></i>登録済み
                            </a>
                            @else
                            <form action="{{ route('picture_books.create') }}" method="GET">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-teal1 shadow-sm btn-block"><i
                                        class="fas fa-plus-circle mr-1"></i>登録する</button>
                                <input type="hidden" name="google_books_id" value="{{ $searchedBook->id }}" />
                                <input type="hidden" name="isbn_13"
                                    value="{{ @$searchedBook->industryIdentifiers[1]->identifier }}" />
                                <input type="hidden" name="title" value="{{ @$searchedBook->title }}" />
                                <input type="hidden" name="authors" value="{{ $searchedBook->authors }}" />
                                <input type="hidden" name="published_date"
                                    value="{{ @$searchedBook->publishedDate }}" />
                                <input type="hidden" name="thumbnail_url"
                                    value="{{ @$searchedBook->imageLinks->thumbnail }}" />
                                <input type="hidden" name="description" value="{{ @$searchedBook->description }}" />
                            </form>
                            @endif
                            @endauth
                            @if ($searchedBook->stored_count !== 0)
                            <a href="{{ route('picture_books.show', ['picture_book' => $searchedBook->picture_book]) }}"
                                class="btn btn-sm btn-outline-teal1 bg-white text-teal1 shadow-sm btn-block mt-2">
                                レビューを読む
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </section>
        {{ $searchedBooks->appends(request()->query())->links('vendor.pagination.bootstrap-4_teal') }}
        @endif
    </div>
</div>

@include('footer')

@endsection
