<section class="card shadow-sm mb-4">
    <div class="card-body border-bottom p-0">
        <div class="row no-gutters">
            {{-- サムネイル --}}
            <div class="col-sm-3">
                <div class="card-body py-0">
                    <a href="{{ route('picture_books.show', ['stored_picture_book' => $stored_picture_book]) }}">
                        <div class="book-cover">
                            @if ($stored_picture_book->pictureBook->thumbnail_uri !== null)
                            <img src="{{ $stored_picture_book->pictureBook->thumbnail_uri }}" alt="book-cover"
                                class="book-cover-image">
                            @else
                            <img src="{{ asset('image/no_image.png') }}" alt="No Image" class="book-cover-image">
                            @endif
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-sm-6 d-flex align-items-center">
                <div class="card-body text-center">
                    <a href="{{ route('picture_books.show', ['stored_picture_book' => $stored_picture_book]) }}"
                        class="card-title text-teal1 h5"><b>{{ $stored_picture_book->pictureBook->title }}</b></a>
                    <div class="card-text text-secondary small">
                        <p>
                            @if ($stored_picture_book->pictureBook->authors !== null)
                            {{ $stored_picture_book->pictureBook->authors }}
                            @endif
                        </p>
                        <p class="card-text text-center">
                            <small class="text-muted">
                                @if ($stored_picture_book->pictureBook->published_date !== null)
                                {{ $stored_picture_book->pictureBook->published_date }}発売
                                @endif
                            </small>
                        </p>
                    </div>
                </div>
            </div>
            <!-- 絵本の読み聞かせ記録ボタン -->
            @if( Auth::id() === $stored_picture_book->user_id )
            <div class="col-sm-3 d-flex align-items-center">
                <div class="card-body">
                    <form action="" method="GET">
                        @csrf
                        <button type="submit" class="btn btn btn-teal1 shadow-sm btn-block" title="絵本の読み聞かせ記録をする"><i
                                class="fas fa-book-reader"></i>
                            よみきかせを記録</button>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>

    <div class="card-body border-bottom">
        <h5 class="card-title small"><i class="fas fa-book-reader"></i><b>よみきかせ記録</b></h5>
        {{-- ダミー値 --}}
        <p class="small">2021.3.20</p>
    </div>

    @if( Auth::id() === $stored_picture_book->user_id )
    <!-- dropdown -->
    <div class="ml-auto card-text">
        <div class="dropdown">
            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <button type="button" class="btn btn-link text-muted m-0 p-2">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item small"
                    href="{{ route("picture_books.edit", ['stored_picture_book' => $stored_picture_book->id]) }}">
                    <i class="fas fa-pen mr-1"></i>レビューを編集する
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-danger small" data-toggle="modal"
                    data-target="#modal-delete-{{ $stored_picture_book->id }}">
                    <i class="fas fa-trash-alt mr-1"></i>本棚から削除する
                </a>
            </div>
        </div>
    </div>
    <!-- dropdown -->

    <!-- modal -->
    <div id="modal-delete-{{ $stored_picture_book->id }}" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST"
                    action="{{ route('picture_books.destroy', ['stored_picture_book' => $stored_picture_book->id]) }}">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        {{ $stored_picture_book->pictureBook->title }}を削除します。よろしいですか？
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

    <div class="card-body pb-0 pr-0">
        <h5 class="card-title small"><i class="far fa-edit"></i><b>レビュー・感想</b></h5>
        <p title="{{ $stored_picture_book->pictureBook->created_at->format('Y/m/d H:i') }}本棚登録">
            <small class="text-muted">
                <i class="far fa-clock"></i>{{ $stored_picture_book->pictureBook->updated_at->format('Y/m/d H:i') }}更新
            </small>
        </p>
    </div>
    <div class="row no-gutters">
        <div class="col-sm-12">
            <div class="card border-0">
                <div class="card-body pt-0 pb-0">
                    @if ($stored_picture_book->five_star_rating !== 0)
                    <p class="small text-warning">
                        @for ($i = 0; $i < (int)$stored_picture_book->five_star_rating; $i++)
                            <i class="fas fa-star"></i>
                            @endfor
                            @for ($i = 0; $i < 5 - (int)$stored_picture_book->five_star_rating;
                                $i++)
                                <i class="far fa-star"></i>
                                @endfor
                    </p>
                    @else
                    <p class="text-secondary small">未評価</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card border-0">
                <div class="card-body pt-0 pb-0">
                    <p class="card-text small">{{ nl2br($stored_picture_book->summary, false) }}</p>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card border-0">
                <div class="card-body">
                    <p class="mb-0">
                        <small class="text-muted">
                            よみきかせ状況： {{ $stored_picture_book->read_status }}
                        </small>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
