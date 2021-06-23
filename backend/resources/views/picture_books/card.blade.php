<section class="pb-4 border-bottom">
    <div class="pt-2 pb-1">
        <a href="{{ route('users.show', ['name' => $pictureBook->user->name]) }}" class="text-dark">
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
    </div>
    <div class="card shadow-sm">
        <div class="row no-gutters">
            {{-- サムネイル --}}
            <div class="col-sm-3">
                <div class="card border-0" style="background-color: transparent">
                    <div class="card-body px-2 pb-2 pt-3 m-0 dropdown drop-hover">
                        <a role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"
                            onclick="location.href='{{ route('picture_books.show', ['picture_book' => $pictureBook]) }}'">

                            <div class="book-cover my-0">
                                @if ($pictureBook->thumbnail_url !== null)
                                <img src="{{ $pictureBook->thumbnail_url }}" alt="book-cover"
                                    class="book-cover-image my-0">
                                @else
                                <img src="{{ asset('image/no_image.png') }}" alt="No Image"
                                    class="book-cover-image my-0">
                                @endif
                            </div>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right mt-0 mx-2 p-0 shadow small"
                            aria-labelledby="dropdownMenuLink">
                            <a href="{{ route('read_records.create', ['picture_book_id' => $pictureBook->id]) }}"
                                class="dropdown-item btn btn-sm text-white bg-teal1 py-2"><i
                                    class="fas fa-book-reader"></i>
                                読み聞かせを記録</a>
                        </div>
                    </div>

                    {{-- レビューいいね機能 --}}
                    <div class="card-body pt-0 pb-1">
                        <div class="card-text small">
                            <review-like :initial-is-liked-by='@json($pictureBook->isLikedBy(Auth::user()))'
                                :initial-count-likes='@json($pictureBook->count_likes)'
                                :authorized='@json(Auth::check())'
                                endpoint="{{ route('picture_books.like', ['picture_book' => $pictureBook]) }}">
                            </review-like>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-9 d-flex align-items-top">
                <div class="card-body pt-3 pb-2">
                    <a href="{{ route('picture_books.show', ['picture_book' => $pictureBook]) }}"
                        class="card-title text-teal1">
                        <b>{{ $pictureBook->title }}</b>
                    </a>
                    <div class="card-text text-secondary small">
                        <p class="mb-1">
                            @if ($pictureBook->authors !== null)
                            {{ $pictureBook->authors }}
                            @endif
                        </p>
                    </div>
                    <div class="card-title mb-0">
                        <span class="small">
                            <i class="far fa-edit"></i><b>レビュー・感想</b>
                        </span>

                        @if( Auth::user()->family_id === $pictureBook->family_id )
                        <!-- dropdown -->
                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <button type="button" class="btn btn-link text-muted m-0 px-2 py-0">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                        </a>

                        <div class="dropdown-menu">
                            <a class="dropdown-item small"
                                href="{{ route('read_records.create', ['picture_book_id' => $pictureBook->id]) }}">
                                <i class="fas fa-book-reader"></i>読み聞かせを記録する
                                ({{ count($pictureBook->readRecords )}}回)
                            </a>

                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item small"
                                href="{{ route("picture_books.edit", ['picture_book' => $pictureBook->id]) }}">
                                <i class="fas fa-pen mr-1"></i>レビューを編集する
                            </a>

                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item text-danger small" data-toggle="modal"
                                data-target="#modal-delete-{{ $pictureBook->id }}">
                                <i class="fas fa-trash-alt mr-1"></i>本棚から削除する
                            </a>
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

                    {{-- よみきかせ状況 --}}
                    <div class="card-body pt-0 pb-2 pl-0">
                        <p class="mb-0">
                            <small class="text-muted">
                                @if ($pictureBook->read_status === 0)
                                よみきかせ状況：<span class="badge badge-secondary">きになる</span>
                                @elseif($pictureBook->read_status === 1)
                                よみきかせ状況：<span class="badge badge-teal1">よんだ</span>
                                @endif
                            </small>
                        </p>
                    </div>

                    <div class="card-body pt-0 pb-2 pl-0">
                        @if ($pictureBook->five_star_rating !== 0)
                        <p class="small text-warning mb-0">
                            @for ($i = 0; $i < (int)$pictureBook->five_star_rating; $i++)
                                <i class="fas fa-star"></i>
                                @endfor
                                @for ($i = 0; $i < 5 - (int)$pictureBook->five_star_rating;
                                    $i++)
                                    <i class="far fa-star"></i>
                                    @endfor
                        </p>
                        @else
                        <p class="text-secondary small">未評価</p>
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
