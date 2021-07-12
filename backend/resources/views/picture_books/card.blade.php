<section class="py-4">
    <div class="py-1">
        <a href="{{ route('users.index', ['name' => $pictureBook->user->name]) }}" class="text-dark">
            @if ($pictureBook->user->icon_path)
            <img src="{{ asset($pictureBook->user->icon_path) }}" class="border" alt="プロフィール画像" style="width:25px; height:25px;background-position: center
                            center;border-radius: 50%;object-fit:cover;">
            @else
            <i class="far fa-user-circle fa-1x"></i>
            @endif
            <span class="text-teal1 small">
                {{ ' ' . $pictureBook->user->nickname}}
            </span>
        </a>
        @if ($pictureBook->created_at == $pictureBook->updated_at)
        <span class="text-muted small">
            さんが『
            <a href="{{ route('picture_books.show', ['picture_book' => $pictureBook]) }}"
                class="card-title text-teal1"><b>{{ $pictureBook->title }}</b></a>
            』を本棚に登録しました。
        </span>
        @else
        <span class="text-muted small">
            さんが本棚の『
            <a href="{{ route('picture_books.show', ['picture_book' => $pictureBook]) }}"
                class="card-title text-teal1"><b>{{ $pictureBook->title }}</b></a>
            』を更新しました。
        </span>
        @endif

        <span class="text-muted small">
            @if (Carbon\Carbon::parse($pictureBook->updated_at)->diffInDays(now()) == 0)
            (今日)
            @else
            ({{ Carbon\Carbon::parse($pictureBook->updated_at)->diffInDays(now()) }}日前)
            @endif
        </span>
    </div>
    <div class="card shadow-sm">
        <div class="row no-gutters">
            {{-- thumbnail --}}
            <div class="col-sm-3 d-flex justify-content-center align-items-top">
                <a href="{{ route('families.show', [
                                        'id' => Auth::user()->family_id,
                                        'picture_book' => $pictureBook,
                                        ]) }}" class="m-4">
                    <div class="card-img-top book-cover m-auto">
                        @if ($pictureBook->thumbnail_url !== null)
                        <img src="{{ $pictureBook->thumbnail_url }}" alt="book-cover" class="book-cover-image">
                        @else
                        <div class="no-image-background book-cover-image">
                            <div class="no-image-title">
                                <div class="ml-3 mr-2">
                                    <p class="text-shadow x-small mb-0" style="line-height:14px;">
                                        {{ $pictureBook->title }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </a>
            </div>

            <div class="col-sm-9 d-flex align-items-top">
                <div class="card-body">
                    <div class="card-title mb-0 d-flex align-items-center flex-wrap">
                        <a href="{{ route('picture_books.show', ['picture_book' => $pictureBook]) }}"
                            class="text-teal1 mr-2">
                            <b>{{ $pictureBook->title }}</b>
                        </a>
                        <span class="small">
                            <review-like :initial-is-liked-by='@json($pictureBook->isLikedBy(Auth::user()))'
                                :initial-count-likes='@json($pictureBook->count_likes)'
                                :authorized='@json(Auth::check())'
                                endpoint="{{ route('picture_books.like', ['picture_book' => $pictureBook]) }}">
                            </review-like>
                        </span>
                        @if( Auth::user()->family_id === $pictureBook->family_id )
                        <!-- dropdown (edit & delete) -->
                        <div class="btn-group dropleft drop-hover d-flex ml-auto">
                            <button type="button" class="btn btn-sm btn-white dropdown-toggle pl-0 text-secondary"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mx-1">
                                    <i class="fas fa-edit"></i>
                                </span>
                            </button>

                            <div class="dropdown-menu mr-0">
                                <a class="dropdown-item btn btn-sm text-center text-teal1"
                                    href="{{ route('read_records.create', ['picture_book_id' => $pictureBook->id]) }}">
                                    <i class="fas fa-book-reader mr-1"></i>よんだよ記録をする
                                </a>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item btn btn-white btn-sm text-center"
                                    href="{{ route("picture_books.edit", ['picture_book' => $pictureBook->id]) }}">
                                    <i class="fas fa-pen mr-1"></i>レビューを編集する
                                </a>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item btn btn-white btn-sm text-danger text-center"
                                    data-toggle="modal" data-target="#modal-delete-{{ $pictureBook->id }}"
                                    style="cursor: pointer;">
                                    <i class="fas fa-trash-alt mr-1"></i>本棚から削除する
                                </a>
                            </div>
                        </div>
                        <!-- dropdown -->

                        <!-- modal -->
                        <div id="modal-delete-{{ $pictureBook->id }}" class="modal fade" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="POST"
                                        action="{{ route('picture_books.destroy', ['picture_book' => $pictureBook->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-body">
                                            {{ $pictureBook->title }}を削除します。よろしいですか？
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                                            <button type="submit" class="btn btn-danger">削除する</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- modal -->
                        @endif
                    </div>
                    <div class="card-text text-secondary small">
                        <p class="mb-1">
                            @if ($pictureBook->authors !== null)
                            {{ $pictureBook->authors }}
                            @endif
                        </p>
                    </div>

                    <div class="card-title mb-0">
                        <span>
                            <b>絵本のレビュー</b>
                        </span>
                    </div>

                    {{-- よみきかせ状況 --}}
                    <div class="card-body pt-0 pl-0 pb-2 d-flex align-items-end flex-wrap">
                        <span class="small text-secondary mb-0 mr-4">
                            @if ($pictureBook->read_status === 0)
                            よみきかせ状況：<span class="badge badge-secondary">きになる</span>
                            @elseif($pictureBook->read_status === 1)
                            よみきかせ状況：<span class="badge badge-teal1">よんだ</span>
                            @endif
                        </span>
                        @if ($pictureBook->five_star_rating !== 0)
                        <span class="small text-warning">
                            @for ($i = 0; $i < (int)$pictureBook->five_star_rating; $i++)
                                <i class="fas fa-star"></i>
                                @endfor
                                @for ($i = 0; $i < 5 - (int)$pictureBook->five_star_rating;
                                    $i++)
                                    <i class="far fa-star"></i>
                                    @endfor
                        </span>
                        @else
                        <span class="text-secondary small">
                            未評価
                        </span>
                        @endif
                    </div>

                    {{-- レビュー・感想 --}}
                    <div class="card-body pt-0 pb-2 pl-0">
                        <p class="card-text small">{!! nl2br(e($pictureBook->review, false)) !!}</p>
                    </div>
                    <div class="d-flex justify-content-end text-muted"
                        title="更新日：{{ $pictureBook->updated_at->format('Y.m.d') }}">
                        <small>登録日：{{ $pictureBook->created_at->format('Y.m.d') }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
