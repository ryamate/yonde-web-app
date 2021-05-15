<section class="card shadow-sm my-4">
    <div class="card-body border-bottom p-0">
        <div class="row no-gutters">
            <div class="col-sm-12">
                <div class="card-body pt-3 pb-0">
                    <a href="{{ route('users.show', ['yonde_id' => $storedPictureBook->user->yonde_id]) }}"
                        class="text-dark">
                        @if ($storedPictureBook->user->user_icon)
                        <img src="{{ asset('storage/user_images/' . $storedPictureBook->user->user_icon) }}"
                            alt="プロフィール画像" style="width:30px; height:30px;background-position: center
                            center;border-radius: 50%;object-fit:cover;">
                        @else
                        <i class="fas fa-user-circle fa-1x"></i>
                        @endif
                        <span class="text-teal1">
                            {{ ' ' . $storedPictureBook->user->name}}
                        </span>
                    </a>
                    @if ($storedPictureBook->created_at == $storedPictureBook->updated_at)
                    <span class="text-muted">
                        さんが絵本を登録しました。
                    </span>
                    @else
                    <span class="text-muted">
                        さんが登録絵本を更新しました。
                    </span>
                    @endif
                </div>
            </div>
            {{-- サムネイル --}}
            <div class=" col-sm-6">
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
                    <!-- 絵本の読み聞かせ記録ボタン -->
                    @if( Auth::id() === $storedPictureBook->user_id )
                    <div class="card-body">
                        <form action="" method="GET">
                            @csrf
                            <button type="submit" class="btn btn btn-teal1 shadow-sm btn-block" title="絵本の読み聞かせ記録をする"><i
                                    class="fas fa-book-reader"></i>
                                よんだよ</button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="row no-gutters">
            <div class="col-sm-6">
                <div class="card border-0">
                    <div class="card-body pt-2 pb-0">
                        <div class="card-title">
                            <span class="small">
                                <i class="far fa-edit"></i><b>レビュー・感想</b>
                            </span>

                            @if( Auth::id() === $storedPictureBook->user_id )
                            <!-- dropdown -->
                            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <button type="button" class="btn btn-link text-muted m-0 px-2 py-0">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </a>
                            <div class="dropdown-menu">
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
                            <!-- dropdown -->

                            <!-- modal -->
                            <div id="modal-delete-{{ $storedPictureBook->id }}" class="modal fade" tabindex="-1"
                                role="dialog">
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
                        </div>

                        <p class="card-title small text-muted"
                            title="{{ $storedPictureBook->pictureBook->created_at->format('Y/m/d H:i') }}本棚登録">
                            <i class="far fa-clock"></i>
                            {{ $storedPictureBook->pictureBook->updated_at->format('Y/m/d H:i') }}更新
                        </p>
                    </div>

                    {{-- よみきかせ状況 --}}
                    <div class="card-body pt-0">
                        <p class="mb-0">
                            <small class="text-muted">
                                @if ($storedPictureBook->read_status === 0)
                                よみきかせ状況：<span class="badge badge-secondary">きになる</span>
                                @elseif($storedPictureBook->read_status === 1)
                                よみきかせ状況：<span class="badge badge-teal1">よんだ</span>
                                @endif
                            </small>
                        </p>
                    </div>

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

                    {{-- レビュー・感想 --}}
                    <div class="card-body pt-0 pb-0">
                        <p class="card-text small">{{ nl2br($storedPictureBook->review, false) }}</p>
                    </div>

                    {{-- タグ --}}
                    @foreach($storedPictureBook->tags as $tag)
                    @if($loop->first)
                    <div class="card-body pt-0 pb-4 pl-3">
                        <div class="card-text line-height">
                            @endif
                            <a href="{{ route('tags.show', ['name' => $tag->name]) }}"
                                class="p-1 mr-1 mt-1 text-teal1 small">
                                {{ $tag->hashtag }}
                            </a>
                            @if($loop->last)
                        </div>
                    </div>
                    @endif
                    @endforeach

                    {{-- レビューいいね機能 --}}
                    <div class="card-body pt-0">
                        <div class="card-text small">
                            <review-like :initial-is-liked-by='@json($storedPictureBook->isLikedBy(Auth::user()))'
                                :initial-count-likes='@json($storedPictureBook->count_likes)'
                                :authorized='@json(Auth::check())'
                                endpoint="{{ route('picture_books.like', ['stored_picture_book' => $storedPictureBook]) }}">
                            </review-like>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-sm-6">
                <div class="card border-0">
                    <div class="card-body pt-2 pb-0">
                        <div class="card-title">
                            <span class="small">
                                <i class="fas fa-book-reader"></i><b>よんだよ記録</b>
                            </span>
                        </div>
                        {{-- ダミー値 --}}
                        <p class="small">2021.3.20</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
