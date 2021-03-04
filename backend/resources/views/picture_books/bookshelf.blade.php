@extends('app')

@section('title', '絵本一覧-Yonde-')

@section('content')

    @include('nav')

    <div class="container" style="max-width: 540px;">
        {{-- 絵本の記録表示 --}}
        @foreach($stored_picture_books as $stored_picture_book)
                <div class="card mb-3">
                    <!-- 登録絵本情報 -->
                    <div class="row no-gutters">
                        <div class="col-sm-5">
                            {{-- <img src="" alt="表紙イメージ" class="border-right border-bottom" width="100%" height="100%" style="max-width: 280px; border-radius: 2px;"> --}}
                            <svg class="bd-placeholder-img" width="100%" height="200" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Image">
                                <title>表紙のイメージがありません</title>
                                <rect fill="#868e96" width="100%" height="100%" /><text fill="#dee2e6" dy=".3em" x="20%" y="50%">No Image</text>
                            </svg>
                        </div>
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title"><b>{{ $stored_picture_book->title }}</b></h5>
                                <p class="card-text">
                                    @if ($stored_picture_book->authors !== null)
                                        {{ $stored_picture_book->authors }}
                                    @endif
                                </p>
                                <p class="card-text">
                                <small class="text-muted">
                                    @if ($stored_picture_book->published_date !== null)
                                    {{ $stored_picture_book->published_date }}発売
                                    @endif
                                </small>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- 絵本の読み聞かせ記録ボタン -->
                    <div class="card-body bg-light">
                        <form action="" method="POST">
                            <button type="submit" class="btn btn-teal1 btn-sm btn-block" title="絵本の読み聞かせ記録をする"><i class="fas fa-book-reader"></i>よみきかせの記録をする</button>
                        </form>
                    </div>

                    <div class="card-body bg-light">
                        <h5 class="card-title small"><i class="fas fa-book-reader"></i><b>よみきかせ記録</b></h5>
                    </div>

                    <div class="card-body pb-0 pr-0">
                        <h5 class="card-title small"><i class="far fa-edit"></i><b>レビュー</b></h5>
                        <p title="{{ date('Y-m-d', strtotime($stored_picture_book->created_at)) }}本棚登録">
                            <small class="text-muted">
                                <i class="far fa-clock"></i>{{ date('Y-m-d', strtotime($stored_picture_book->updated_at)) }}更新
                            </small>
                        </p>
                    </div>
                    <div class="row no-gutters">
                        <div class="col-sm-12">
                            <div class="card border-0">
                                <div class="card-body pt-0 pb-0">
                                    @if ($stored_picture_book->five_star_rating !== '0')
                                        <p class="small text-warning">
                                            @for ($i = 0; $i < (int)$stored_picture_book->five_star_rating; $i++)
                                                <i class="fas fa-star"></i>
                                            @endfor
                                            @for ($i = 0; $i < 5 - (int)$stored_picture_book->five_star_rating; $i++)
                                                <i class="far fa-star"></i>
                                            @endfor
                                        </p>
                                    @else
                                        <p class="text-secondary">未評価</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="card border-0">
                                <div class="card-body pt-0 pb-0">
                                    <p class="mb-0">
                                        <small class="text-muted">
                                            よみきかせ状況： {{ $stored_picture_book->read_status }}
                                        </small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-0">
                        <div class="card-body">
                            <p class="card-text small">{{ nl2br($stored_picture_book->summary, false) }}</p>
                        </div>
                    </div>
                    <!-- レビューを編集するボタン -->
                    <div class="row no-gutters">
                        <div class="col-sm-10">
                            <div class="card border-0">
                                <div class="card-body pb-0">
                                    <form action="" method="POST">
                                        <button type="submit" class="btn btn-outline-teal1 bg-white text-teal1 btn-sm btn-block" title="レビュー（おすすめ度や感想）を編集する"><i class="far fa-edit"></i>レビューを編集する</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- 登録絵本の削除ボタン -->
                        <div class="col-sm-2">
                            <div class="card border-0 text-right">
                                <div class="card-body">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        @endforeach
    </div>
@endsection
