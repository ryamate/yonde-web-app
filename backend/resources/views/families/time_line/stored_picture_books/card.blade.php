<div class="card shadow mb-4">
    <div class="row no-gutters">
        {{-- thumbnail --}}
        <div class="col-sm-3 d-flex justify-content-center align-items-top">
            <a href="{{ $hasStored
            ? route('families.show', ['name' => $family->name,'picture_book' => $pictureBook])
            : route('picture_books.show', ['picture_book' => $pictureBook])
             }}" class="m-4 text-decoration-none">
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
            </a>
        </div>

        <div class="col-sm-9 d-flex align-items-top">
            <div class="card-body">
                <div class="card-title mb-0 d-flex align-items-center flex-wrap">
                    <a href="{{ $hasStored
            ? route('families.show', ['name' => $family->name,'picture_book' => $pictureBook])
            : route('picture_books.show', ['picture_book' => $pictureBook])
             }}" class="text-teal1 mr-2">
                        <b>{{ $pictureBook->title }}</b>
                    </a>
                </div>
                <div class="card-text d-flex align-items-center flex-wrap">
                    <span class="text-secondary small mb-1">
                        @if ($pictureBook->authors !== null)
                        {{ $pictureBook->authors }}
                        @endif
                    </span>
                    @if( Auth::user()->family_id === $pictureBook->family_id )
                    <!-- dropdown (edit & delete) -->
                    <div class="btn-group drop-hover d-flex ml-auto">
                        <a class="btn btn-sm btn-teal1"
                            href="{{ route('read_records.create', ['picture_book_id' => $pictureBook->id]) }}">
                            <i class="fas fa-book-open mr-1"></i>よんだよ
                        </a>
                        <button type="button" class="btn btn-sm btn-teal1 dropdown-toggle dropdown-toggle-split"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>

                        <div class="dropdown-menu dropdown-menu-right mt-0 mr-0">
                            <a class="dropdown-item btn btn-white btn-sm text-center"
                                href="{{ route("picture_books.edit", ['picture_book' => $pictureBook->id]) }}">
                                <i class="fas fa-pen text-dark mr-1"></i>レビュー編集
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item btn btn-white btn-sm text-pink text-center" data-toggle="modal"
                                data-target="#modal-delete-{{ $pictureBook->id }}" style="cursor: pointer;">
                                <i class="fas fa-trash-alt mr-1"></i>本棚から削除
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
                                        『{{ $pictureBook->title }}』を本棚から削除します。よろしいですか？
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

                <div class="card-title mb-0">
                    <a href="{{ route('picture_books.show', ['picture_book' => $pictureBook]) }}"
                        class="text-dark text-decoration-none">
                        <b>絵本のレビュー</b>
                    </a>
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
                    <span class="small text-lemon-tea">
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
                    <p class="card-text small">
                        {!! nl2br(e($pictureBook->review, false)) !!}
                    </p>
                    <div class="card-text d-flex align-items-center flex-wrap">
                        <span class="small">
                            <review-like :initial-is-liked-by='@json($pictureBook->isLikedBy(Auth::user()))'
                                :initial-count-likes='@json($pictureBook->count_likes)'
                                :authorized='@json(Auth::check())'
                                endpoint="{{ route('picture_books.like', ['picture_book' => $pictureBook]) }}">
                            </review-like>
                        </span>
                        <div class="d-flex ml-auto text-muted"
                            title="更新日：{{ $pictureBook->updated_at->format('Y.m.d') }}">
                            <small>登録日：{{ $pictureBook->created_at->format('Y.m.d') }}</small>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
