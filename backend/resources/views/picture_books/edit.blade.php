@extends('app')

@section('title', '絵本情報編集-よんで-')

@section('content')

@include('nav')

<header>
    <div class="bg-light">
        <div class="container" style="max-width: 900px;">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-light small pl-0 mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" class="text-teal1">よんで</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('families.index', ['id' => Auth::user()->family_id]) }}"
                            class="text-teal1">タイムライン</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $pictureBook->title }}
                    </li>
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
                                        @if ($pictureBook->thumbnail_url !== null)
                                        <img src="{{ $pictureBook->thumbnail_url }}" alt="book-cover"
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
                                        <b>{{ $pictureBook->title }}</b>
                                    </div>
                                    <div class="card-text small d-flex justify-content-center">
                                        <p>
                                            @if ($pictureBook->authors !== null)
                                            {{ $pictureBook->authors }}/
                                            @endif
                                            @if ($pictureBook->published_date !== null)
                                            {{ $pictureBook->published_date }}発売
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
                            <form method="POST"
                                action="{{ route('picture_books.update',['picture_book' => $pictureBook ]) }}">
                                @method('PATCH')
                                @include('picture_books.form')
                                <button type="submit" class="btn btn-teal1 shadow-sm btn-block">更新する</button>
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
