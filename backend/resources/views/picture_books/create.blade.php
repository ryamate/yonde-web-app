@extends('app')

@section('title', '絵本登録-Yonde-')

@section('content')

@include('nav')

<header>
    <div class="bg-light">
        <div class="container" style="max-width: 900px;">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-light small pl-0 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('picture_books.index') }}" class="text-teal1">よんで</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('search') }}" class="text-teal1">絵本検索</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $picture_book->title }}</li>
                </ol>
            </nav>
        </div>
    </div>
</header>

<div class="bg-light">
    <div class="container">
        <div class="row">
            <div class="container" style="max-width: 540px;">
                <h2>登録情報の編集</h2>
                <section class="card shadow-sm mb-4">
                    <div class="card-body border-bottom p-0">
                        <div class="row no-gutters">
                            {{-- サムネイル --}}
                            <div class="col-sm-6">
                                <div class="card-body py-0">
                                    <div class="book-cover">
                                        @if ($picture_book->thumbnail_uri !== null)
                                        <img src="{{ $picture_book->thumbnail_uri }}" alt="book-cover"
                                            class="book-cover-image">
                                        @else
                                        <img src="{{ asset('image/no_image.png') }}" alt="No Image"
                                            class="book-cover-image">
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- タイトル, 作者/出版年月 --}}
                            <div class="col-sm-6 d-flex align-items-center justify-content-center">
                                <div class="card-body">
                                    <div class="card-title h5 d-flex justify-content-center">
                                        <b>{{ $picture_book->title }}</b>
                                    </div>
                                    <div class="card-text small d-flex justify-content-center">
                                        <p>
                                            @if ($picture_book->authors !== null)
                                            {{ $picture_book->authors }}/
                                            @endif
                                            @if ($picture_book->published_date !== null)
                                            {{ $picture_book->published_date }}発売
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('error_card_list')
                        <div class="card-text">
                            <form method="POST" action="{{ route('picture_books.store') }}">
                                @include('picture_books.form')
                                <button type="submit" class="btn btn btn-teal1 shadow-sm btn-block">登録する</button>
                                <input type="hidden" name="google_books_id"
                                    value="{{ $picture_book->google_books_id }}" />
                                <input type="hidden" name="isbn_13" value="{{ $picture_book->isbn_13 }}" />
                                <input type="hidden" name="title" value="{{ $picture_book->title }}" />
                                <input type="hidden" name="authors" value="{{ $picture_book->authors }}" />
                                <input type="hidden" name="published_date"
                                    value="{{ $picture_book->published_date }}" />
                                <input type="hidden" name="thumbnail_uri" value="{{ $picture_book->thumbnail_uri }}" />
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
