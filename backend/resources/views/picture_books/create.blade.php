@extends('app')

@section('title', '絵本登録-よんで-')

@section('content')

@include('nav')

<header>
    <div class="bg-paper">
        <div class="container" style="max-width: 900px;">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-paper small pl-0 mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" class="text-teal1">よんで</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('picture_books.search') }}" class="text-teal1">絵本検索</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $pictureBook->title }}
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</header>

<div class="bg-paper">
    <div class="container pb-4" style="max-width: 540px;">
        <h4>本棚への絵本登録</h4>
        <section class="card shadow-sm">
            <div class="card-body border-bottom p-0">
                @include('picture_books.thumbnail')
            </div>
            <div class="card-body">
                @include('error_card_list')
                <div class="card-text">
                    <form method="POST" action="{{ route('picture_books.store') }}">

                        @include('picture_books.form')

                        <button type="submit" class="btn btn-teal1 shadow-sm btn-block">本棚へ登録する</button>
                        <input type="hidden" name="google_books_id" value="{{ $pictureBook->google_books_id }}" />
                        <input type="hidden" name="isbn_13" value="{{ $pictureBook->isbn_13 }}" />
                        <input type="hidden" name="title" value="{{ $pictureBook->title }}" />
                        <input type="hidden" name="authors" value="{{ $pictureBook->authors }}" />
                        <input type="hidden" name="published_date" value="{{ $pictureBook->published_date }}" />
                        <input type="hidden" name="description" value="{{ $pictureBook->description }}" />
                        <input type="hidden" name="thumbnail_url" value="{{ $pictureBook->thumbnail_url }}" />
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

@include('footer')

@endsection
