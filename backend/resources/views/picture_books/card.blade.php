<section class="card shadow-sm mb-4">
    <div class="card-body border-bottom p-0">
        <div class="row no-gutters">
            <div class="col-sm-12">
                <a href="{{ route('users.show', ['yonde_id' => $storedPictureBook->user->yonde_id]) }}"
                    class="text-dark">
                    @if ($storedPictureBook->user->user_icon)
                    <img src="{{ asset('storage/user_images/' . $storedPictureBook->user->user_icon) }}" alt="プロフィール画像"
                        style="width: 100px; height:100px;background-position: center center;object-fit:cover;">
                    @else
                    <i class="far fa-user-circle fa-5x text-secondary"></i>
                    @endif
                </a>
            </div>
            {{-- サムネイル --}}
            <div class="col-sm-3">
                <div class="card-body py-0">
                    <a href="{{ route('picture_books.show', ['stored_picture_book' => $storedPictureBook]) }}">
                        <div class="book-cover">
                            @if ($storedPictureBook->pictureBook->thumbnail_uri !== null)
                            <img src="{{ $storedPictureBook->pictureBook->thumbnail_uri }}" alt="book-cover"
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
                    <a href="{{ route('picture_books.show', ['stored_picture_book' => $storedPictureBook]) }}"
                        class="card-title text-teal1 h5"><b>{{ $storedPictureBook->pictureBook->title }}</b></a>
                    <div class="card-text text-secondary small">
                        <p>
                            @if ($storedPictureBook->pictureBook->authors !== null)
                            {{ $storedPictureBook->pictureBook->authors }}
                            @endif
                        </p>
                        <p class="card-text text-center">
                            <small class="text-muted">
                                @if ($storedPictureBook->pictureBook->published_date !== null)
                                {{ $storedPictureBook->pictureBook->published_date }}発売
                                @endif
                            </small>
                        </p>
                    </div>
                </div>
            </div>
            <!-- 絵本の読み聞かせ記録ボタン -->
            @if( Auth::id() === $storedPictureBook->user_id )
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

    @if( Auth::id() === $storedPictureBook->user_id )
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
                    href="{{ route("picture_books.edit", ['stored_picture_book' => $storedPictureBook->id]) }}">
                    <i class="fas fa-pen mr-1"></i>レビューを編集する
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-danger small" data-toggle="modal"
                    data-target="#modal-delete-{{ $storedPictureBook->id }}">
                    <i class="fas fa-trash-alt mr-1"></i>本棚から削除する
                </a>
            </div>
        </div>
    </div>
    <!-- dropdown -->

    <!-- modal -->
    <div id="modal-delete-{{ $storedPictureBook->id }}" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST"
                    action="{{ route('picture_books.destroy', ['stored_picture_book' => $storedPictureBook->id]) }}">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        {{ $storedPictureBook->pictureBook->title }}を削除します。よろしいですか？
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
        <p title="{{ $storedPictureBook->pictureBook->created_at->format('Y/m/d H:i') }}本棚登録">
            <small class="text-muted">
                <i class="far fa-clock"></i>{{ $storedPictureBook->pictureBook->updated_at->format('Y/m/d H:i') }}更新
            </small>
        </p>
    </div>
    <div class="row no-gutters">
        <div class="col-sm-12">
            <div class="card border-0">
                <div class="card-body pt-0 pb-0">
                    @if ($storedPictureBook->five_star_rating !== 0)
                    <p class="small text-warning">
                        @for ($i = 0; $i < (int)$storedPictureBook->five_star_rating; $i++)
                            <i class="fas fa-star"></i>
                            @endfor
                            @for ($i = 0; $i < 5 - (int)$storedPictureBook->five_star_rating;
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
                    <p class="card-text small">{{ nl2br($storedPictureBook->summary, false) }}</p>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card border-0">
                <div class="card-body">
                    <p class="mb-0">
                        <small class="text-muted">
                            よみきかせ状況： {{ $storedPictureBook->read_status }}
                        </small>
                    </p>
                </div>
            </div>
        </div>

        {{-- レビューいいね機能 --}}
        <div class="col-sm-12">
            <div class="card border-0">
                <div class="card-body">
                    <div class="card-text">
                        <review-like :initial-is-liked-by='@json($storedPictureBook->isLikedBy(Auth::user()))'
                            :initial-count-likes='@json($storedPictureBook->count_likes)'
                            :authorized='@json(Auth::check())'
                            endpoint="{{ route('picture_books.like', ['stored_picture_book' => $storedPictureBook]) }}">
                        </review-like>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
