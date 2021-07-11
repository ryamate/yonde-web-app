@extends('app')

@section('title', '絵本情報・レビュー-よんで-')

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
                    <li class="breadcrumb-item active" aria-current="page">
                        『{{ $pictureBook->title }}』の絵本情報・レビュー
                    </li>

                </ol>
            </nav>
        </div>
    </div>
</header>

<div class="bg-light">
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
                                    <span class="text-warning mx-2">
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
            <div class="card shadow-sm my-1">
                <div class="row">
                    <div class="col-sm-3" style="height: 75px">
                        <div class="d-flex justify-content-start mt-4 ml-4">
                            <div class="" style="position: relative;">
                                @auth
                                <a href="{{ route('families.bookshelf', ["id" => $reviewedPictureBook->family->id]) }}">
                                    @endauth
                                    @foreach ($reviewedPictureBook->family->users as $user)
                                    @if ($user->icon_path)
                                    <img src="{{ asset($user->icon_path) }}" alt="プロフィール画像" class="bg-white border"
                                        style="width: 30px; height:30px;
                                            border-radius: 50%;object-fit:cover; position: absolute;
                                            left:{{ ($loop->iteration - 1) * 25 }}px;" />
                                    @else
                                    <i class="far fa-user-circle fa-2x text-secondary bg-light"
                                        style="border-radius: 50%;object-fit:cover; position: absolute; left:{{ ($loop->iteration - 1) * 25 }}px;"></i>
                                    @endif
                                    @endforeach

                                    @foreach ($reviewedPictureBook->family->children->sortBy('birthday') as
                                    $child)
                                    @if(Carbon\Carbon::parse($child->birthday)->lte(Carbon\Carbon::now()->subYear())
                                    && $child->gender_code === 2)
                                    <img src="{{ asset('image/girl.png') }}" alt="プロフィール画像" class="bg-light border"
                                        style="width: 30px; height:30px; border-radius: 50%;object-fit:cover; position: absolute; top:25px; left:{{ ($loop->iteration - 1) * 25 + 15 }}px;"
                                        title="{{ ($child->birthday !== null) ? Carbon\Carbon::parse($child->birthday)->diff(Carbon\Carbon::now())->format('%y歳') : '' }}" />
                                    @elseif(Carbon\Carbon::parse($child->birthday)->lte(Carbon\Carbon::now()->subYear()))
                                    <img src="{{ asset('image/boy.png') }}" alt="プロフィール画像" class="bg-light border"
                                        style="width: 30px; height:30px; border-radius: 50%;object-fit:cover; position: absolute; top:25px; left:{{ ($loop->iteration - 1) * 25 + 15 }}px;"
                                        title="{{ ($child->birthday !== null) ? Carbon\Carbon::parse($child->birthday)->diff(Carbon\Carbon::now())->format('%y歳') : '' }}" />
                                    @else
                                    <img src="{{ asset('image/baby.png') }}" alt="プロフィール画像" class="bg-light border"
                                        style="width: 30px; height:30px; border-radius: 50%;object-fit:cover; position: absolute; top:25px; left:{{ ($loop->iteration - 1) * 25 + 15 }}px;"
                                        title="{{ ($child->birthday !== null) ? Carbon\Carbon::parse($child->birthday)->diff(Carbon\Carbon::now())->format('%y歳') : '' }}" />
                                    @endif
                                    @endforeach
                                    @auth
                                </a>
                                @endauth
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-9 d-flex align-items-top">
                        <div class="card-body">
                            <div class="card-title">
                                <span class="d-flex justify-content-start flex-wrap my-2">
                                    <span class="small">
                                        {{ $reviewedPictureBook->family->name }}ファミリーのレビュー
                                    </span>
                                    <span
                                        class="d-flex flex-wrap ml-auto mr-2 text-muted small">{{ $reviewedPictureBook->updated_at->format('Y年m月d日') }}</span>
                                </span>
                            </div>
                            {{-- よみきかせ状況 --}}
                            <div class="card-text pt-0 pl-0 pb-2 d-flex align-items-end flex-wrap">
                                <span class="small text-secondary mb-0 mr-4">
                                    @if ($reviewedPictureBook->read_status === 0)
                                    よみきかせ状況：<span class="badge badge-secondary">きになる</span>
                                    @elseif($reviewedPictureBook->read_status === 1)
                                    よみきかせ状況：<span class="badge badge-teal1">よんだ</span>
                                    @endif
                                </span>
                                @if ($reviewedPictureBook->five_star_rating !== 0)
                                <span class="small text-warning">
                                    @for ($i = 0; $i < (int)$reviewedPictureBook->five_star_rating; $i++)
                                        <i class="fas fa-star"></i>
                                        @endfor
                                        @for ($i = 0; $i < 5 - (int)$reviewedPictureBook->five_star_rating;
                                            $i++)
                                            <i class="far fa-star"></i>
                                            @endfor
                                </span>
                                @else
                                <span class="text-secondary small">
                                    未評価
                                </span>
                                @endif

                                @auth
                                <span class="small ml-auto mr-2">
                                    <review-like
                                        :initial-is-liked-by='@json($reviewedPictureBook->isLikedBy(Auth::user()))'
                                        :initial-count-likes='@json($reviewedPictureBook->count_likes)'
                                        :authorized='@json(Auth::check())'
                                        endpoint="{{ route('picture_books.like', ['picture_book' => $reviewedPictureBook]) }}">
                                    </review-like>
                                </span>
                                @endauth
                            </div>

                            {{-- レビュー・感想 --}}
                            <div class="card-body pt-0 pb-2 pl-0">
                                <p class="card-text" style="font-size: 14px; ">
                                    {!! nl2br(e($reviewedPictureBook->review, false)) !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <p class="text-muted">この絵本のレビューはまだありません。</p>
            @endif
        </section>
    </div>
</div>

@include('footer')

@endsection
