<section class="card shadow-sm my-4">
    <div class="card-body border-bottom p-0">
        <div class="row no-gutters">
            <div class="col-sm-12">
                <div class="card-body pt-3 pb-0">
                    <a href="{{ route('users.show', ['name' => $pictureBook->user->name]) }}" class="text-dark">
                        @if ($pictureBook->user->icon_path)
                        <img src="{{ asset($pictureBook->user->icon_path) }}" alt="プロフィール画像" style="width:30px; height:30px;background-position: center
                            center;border-radius: 50%;object-fit:cover;">
                        @else
                        <i class="far fa-user-circle fa-1x"></i>
                        @endif
                        <span class="text-teal1">
                            {{ ' ' . $pictureBook->user->nickname}}
                        </span>
                    </a>
                    @if ($pictureBook->created_at == $pictureBook->updated_at)
                    <span class="text-muted">
                        さんが読み聞かせを記録しました。
                    </span>
                    @else
                    <span class="text-muted">
                        さんが読み聞かせを記録を更新しました。
                    </span>
                    @endif
                </div>
            </div>
            {{-- サムネイル --}}
            <div class="col-sm-6">
                <div class="card border-0" style="background-color: transparent">
                    <div class="card-body py-0">
                        <a href="{{ route('picture_books.show', ['picture_book' => $pictureBook]) }}">
                            <div class="book-cover">
                                @if ($pictureBook->thumbnail_url !== null)
                                <img src="{{ $pictureBook->thumbnail_url }}" alt="book-cover" class="book-cover-image">
                                @else
                                <img src="{{ asset('image/no_image.png') }}" alt="No Image" class="book-cover-image">
                                @endif
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 d-flex align-items-center">
                <div class="card-body text-center">
                    <a href="{{ route('picture_books.show', ['picture_book' => $pictureBook]) }}"
                        class="card-title text-teal1 h5"><b>{{ $pictureBook->title }}</b></a>
                    <div class="card-text text-secondary small">
                        <p>
                            @if ($pictureBook->authors !== null)
                            {{ $pictureBook->authors }}
                            @endif
                        </p>
                        <p class="card-text text-center">
                            <small class="text-muted">
                                @if ($pictureBook->published_date !== null)
                                {{ $pictureBook->published_date }}発売
                                @endif
                            </small>
                        </p>
                    </div>
                    <!-- 絵本の読み聞かせ記録ボタン -->
                    @if( Auth::user()->family_id === $pictureBook->family_id )
                    <div class="card-body">
                        <form action="{{ route('read_records.create') }}" method="GET">
                            @csrf
                            <button type="submit" class="btn btn-teal1 shadow-sm btn-block" title="絵本の読み聞かせ記録をする">
                                <i class="fas fa-book-reader"></i><b>よんだよ</b>
                            </button>
                            <input type="hidden" name="picture_book_id" value="{{ $pictureBook->id }}" />
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

                            @if( Auth::user()->family_id === $pictureBook->family_id )
                            <!-- dropdown -->
                            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <button type="button" class="btn btn-link text-muted m-0 px-2 py-0">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </a>
                            <div class="dropdown-menu">
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
                            <div id="modal-delete-{{ $pictureBook->id }}" class="modal fade" tabindex="-1"
                                role="dialog">
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

                        <p class="card-title small text-muted"
                            title="{{ $pictureBook->created_at->format('Y/m/d H:i') }}本棚登録">
                            <i class="far fa-clock"></i>
                            {{ $pictureBook->updated_at->format('Y/m/d H:i') }}更新
                        </p>
                    </div>

                    {{-- よみきかせ状況 --}}
                    <div class="card-body pt-0">
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

                    <div class="card-body pt-0 pb-0">
                        @if ($pictureBook->five_star_rating !== 0)
                        <p class="small text-warning">
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
                    <div class="card-body pt-0 pb-0">
                        <p class="card-text small">{!! nl2br(e($pictureBook->review, false)) !!}</p>
                    </div>

                    {{-- レビューいいね機能 --}}
                    <div class="card-body pt-0">
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

            <div class="col-sm-6">
                <div class="card border-0">
                    <div class="card-body py-2">
                        <div class="card-title">
                            <span class="small">
                                <i class="fas fa-book-reader"></i><b>よんだよ記録</b>({{ count($pictureBook->readRecords )}}回)
                            </span>
                        </div>
                        @if (count($pictureBook->readRecords) !== 0 )
                        @foreach ($pictureBook->readRecords as $readRecord)
                        <div class="pb-1">
                            <form action="{{ route("read_records.edit", ['read_record' => $readRecord->id]) }}"
                                method="GET">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-teal1 shadow-sm" title="絵本の読み聞かせ記録をする">
                                    {{Carbon\Carbon::parse($readRecord->read_date)->format("Y年m月d日") }}
                                </button>
                                <input type="hidden" name="picture_book_id" value="{{ $pictureBook->id }}" />
                            </form>
                            {{-- タグ --}}
                            @foreach($readRecord->tags as $tag)
                            @if($loop->first)
                            {{-- <div class="card-body pt-0 pb-4 pl-3"> --}}
                            <div class="card-text line-height">
                                @endif
                                <a href="{{ route('tags.show', ['name' => $tag->name]) }}"
                                    class="p-1 mr-1 mt-1 text-teal1 small">
                                    {{ $tag->hashtag }}
                                </a>
                                @if($loop->last)
                                {{-- </div> --}}
                            </div>
                            @endif
                            @endforeach

                            {{-- お子さまタグ --}}
                            @foreach($readRecord->children as $child)
                            @if($loop->first)
                            {{-- <div class="card-body pt-0 pb-4 pl-3"> --}}
                            <div class="card-text line-height">
                                @endif
                                <a href="{{ route('children.show', ['id' => $child->id]) }}"
                                    class="p-1 mr-1 mt-1 text-teal1 small">
                                    {{ $child->name }}
                                </a>
                                @if($loop->last)
                                {{-- </div> --}}
                            </div>
                            @endif
                            @endforeach

                        </div>
                        @endforeach
                        @else
                        <p class="small">
                            記録なし
                        </p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
