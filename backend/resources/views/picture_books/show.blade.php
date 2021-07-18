@extends('app')

@section('title', '絵本情報・レビュー-よんで-')

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
                        『{{ $pictureBook->title }}』の絵本情報・レビュー
                    </li>

                </ol>
            </nav>
        </div>
    </div>
</header>

<div class="bg-paper">
    <div class="container" style="max-width: 900px;">
        <section class="py-4">
            <div>
                <h4>絵本情報</h4>
            </div>
            <div class="card shadow">
                <div class="row no-gutters">
                    {{-- thumbnail --}}
                    <div class="col-sm-3 d-flex justify-content-center align-items-top">
                        <div class="m-4">
                            <div class="card-img-top book-cover m-auto">
                                @if ($pictureBook->thumbnail_url !== null)
                                <img src="{{ $pictureBook->thumbnail_url }}" alt="book-cover" class="book-cover-image">
                                @else
                                <div class="no-image-background book-cover-image">
                                    <div class="no-image-title">
                                        <div class="ml-4 mr-3">
                                            <p class="text-white text-shadow small mb-0" style="line-height:14px;">
                                                no-image
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-9 col-md-6 d-flex align-items-top">
                        <div class="card-body">
                            <div class="card-title mb-0 d-flex align-items-center flex-wrap">
                                <h5>
                                    {{ $pictureBook->title }}
                                </h5>
                            </div>
                            <div class="card-text d-flex align-items-center flex-wrap">
                                <span class="small mb-1">
                                    @if ($pictureBook->authors !== null)
                                    {{ $pictureBook->authors }}
                                    @endif
                                </span>
                            </div>
                            <div class="card-text small mt-2 mb-2">
                                <span class="d-flex justify-content-start flex-wrap">
                                    <span class="text-info mx-2" title="登録数">
                                        <i class="fas fa-book"></i>
                                        <b>{{ $pictureBook->stored_count }}</b>
                                    </span>
                                    <span class="text-teal1 mx-2" title="読み聞かせ回数">
                                        <i class="fas fa-book-reader"></i>
                                        <b>{{ $pictureBook->read_records_count }}</b><span class="text-dark">回</span>
                                    </span>
                                    <span class="text-lemon-tea mx-2">
                                        <i class="fas fa-star"></i>
                                        <b>{{ $pictureBook->five_star_avg }}</b>
                                    </span>
                                    <a href="" class="text-info mx-2" title="レビュー件数">
                                        <i class="fas fa-pen"></i>
                                        <b>{{ $pictureBook->review_count }}</b><span class="text-dark">件</span>
                                    </a>
                                </span>
                            </div>
                            @if ($pictureBook->description !== null)
                            <p class="mb-0 small">
                                {{ $pictureBook->description }}
                            </p>
                            @endif
                        </div>
                    </div>

                    <!-- 登録ボタン -->
                    <div class="col-md-3 d-flex align-items-center">
                        <div class="card-body">
                            @auth
                            @if ($family->pictureBooks->firstWhere('google_books_id',
                            $pictureBook->google_books_id))
                            <a class="btn btn-sm btn-block btn-outline-teal1 text-teal1 bg-white shadow-sm"
                                href="{{ route("families.show", [
                                            'id' => Auth::user()->family_id,
                                            'picture_book' => $family->pictureBooks->firstWhere('google_books_id', $pictureBook->google_books_id)]) }}">
                                <i class="fas fa-book mr-1"></i>登録済み
                            </a>
                            @else
                            <form action="{{ route('picture_books.create') }}" method="GET">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-teal1 shadow-sm btn-block"><i
                                        class="fas fa-plus-circle mr-1"></i>登録する</button>
                                <input type="hidden" name="google_books_id"
                                    value="{{ $pictureBook->google_books_id }}" />
                                <input type="hidden" name="isbn_13" value="{{ $pictureBook->isbn_13 }}" />
                                <input type="hidden" name="title" value="{{ $pictureBook->title }}" />
                                <input type="hidden" name="authors" value="{{ $pictureBook->authors }}" />
                                <input type="hidden" name="published_date" value="{{ $pictureBook->published_date }}" />
                                <input type="hidden" name="thumbnail_url" value="{{ $pictureBook->thumbnail_url }}" />
                                <input type="hidden" name="description" value="{{ $pictureBook->description }}" />
                            </form>
                            @endif
                            @endauth
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="py-4">
            <div>
                <h5>みんなのレビュー</h5>
            </div>
            @if ($pictureBook->review_count !== 0)
            @foreach ($reviewedPictureBooks as $reviewedPictureBook)

            @include('picture_books.reviews.card')

            @endforeach
            @else
            <p class="text-muted">この絵本のレビューはまだありません。</p>
            @endif
        </section>
    </div>
</div>

@include('footer')

@endsection
