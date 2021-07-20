@extends('app')

@section('title', '絵本情報編集-よんで-')

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
                    <li class="breadcrumb-item active" aria-current="page">
                        『{{ $pictureBook->title }}』の登録絵本情報の編集
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</header>

<div class="bg-paper">
    <div class="container pb-4" style="max-width: 540px;">
        <h4>登録絵本情報の編集</h4>
        <section class="card shadow-sm">
            <div class="card-body border-bottom p-0">
                @include('picture_books.thumbnail')
            </div>
            <div class="card-body">
                @include('error_card_list')
                <div class="card-text">
                    <form method="POST" action="{{ route('picture_books.update',['picture_book' => $pictureBook ]) }}">
                        @method('PATCH')

                        @include('picture_books.form')

                        <button type="submit" class="btn btn-teal1 shadow-sm btn-block">
                            <b>編集完了する</b>
                        </button>
                        <button type="button" onClick="history.back()"
                            class="btn btn-block bg-white btn-outline-teal1 text-decoration-none text-teal1 mt-3">
                            <i class="fas fa-arrow-left mr-1"></i>戻る
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

@include('footer')

@endsection
