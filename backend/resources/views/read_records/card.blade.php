<section class="py-4">
    <div class="py-1">
        <a href="{{ route('users.show', ['name' => $readRecord->user->name]) }}" class="text-dark">
            @if ($readRecord->user->icon_path)
            <img src="{{ asset($readRecord->user->icon_path) }}" class="border" alt="プロフィール画像" style="width:25px; height:25px;background-position: center
                            center;border-radius: 50%;object-fit:cover;">
            @else
            <i class="far fa-user-circle fa-1x"></i>
            @endif
            <span class="text-teal1 small">
                {{ ' ' . $readRecord->user->nickname}}
            </span>
        </a>
        @if ($readRecord->pictureBook->created_at == $readRecord->pictureBook->updated_at)
        <span class="text-muted small">
            さんが『
            <a href="{{ route('families.show', [
                                        'id' => Auth::user()->family_id,
                                        'picture_book' => $readRecord->pictureBook,
                                        ]) }}"
                class="card-title text-teal1"><b>{{ $readRecord->pictureBook->title }}</b></a>
            』の読み聞かせ記録をしました。
        </span>
        @else
        <span class="text-muted small">
            さんが『
            <a href="{{ route('families.show', [
                                        'id' => Auth::user()->family_id,
                                        'picture_book' => $readRecord->pictureBook,
                                        ]) }}"
                class="card-title text-teal1"><b>{{ $readRecord->pictureBook->title }}</b></a>
            』の読み聞かせ記録を更新しました。
        </span>
        @endif

        <span class="text-muted small">
            @if (Carbon\Carbon::parse($readRecord->updated_at)->diffInDays(now()) == 0)
            (今日)
            @else
            ({{ Carbon\Carbon::parse($readRecord->updated_at)->diffInDays(now()) }}日前)
            @endif
        </span>
    </div>
    <div class="card shadow-sm">
        <div class="row no-gutters">
            {{-- thumbnail --}}
            <div class="col-sm-2 d-flex justify-content-center align-items-top">
                <a href="{{ route('families.show', [
                                        'id' => Auth::user()->family_id,
                                        'picture_book' => $readRecord->pictureBook,
                                        ]) }}" class="m-4 text-decoration-none">
                    <div class="card-img-top book-cover m-auto">
                        @if ($readRecord->pictureBook->thumbnail_url !== null)
                        <img src="{{ $readRecord->pictureBook->thumbnail_url }}" alt="book-cover"
                            class="book-cover-image">
                        @else
                        <div class="no-image-background book-cover-image">
                            <div class="no-image-title">
                                <div class="ml-3 mr-2">
                                    <p class="text-white text-shadow x-small mb-0" style="line-height:14px;">
                                        no-image
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </a>
            </div>

            {{-- read record --}}
            <div class="col-sm-10 d-flex align-items-top">
                <div class="card-body pt-3 pb-2">
                    <div class="card-title mb-0 d-flex align-items-center flex-wrap small">
                        <a href="{{ route('families.show', [
                                        'id' => Auth::user()->family_id,
                                        'picture_book' => $readRecord->pictureBook,
                                        ]) }}" class="text-teal1 mr-4"
                            title="作者：{{ $readRecord->pictureBook->authors !== null ? $readRecord->pictureBook->authors : '' }}">
                            <b>{{ $readRecord->pictureBook->title }}</b>
                        </a>
                        @if (Auth::user()->family_id === $readRecord->pictureBook->family_id)
                        <!-- dropdown (edit & delete) -->
                        <div class="btn-group dropleft drop-hover d-flex ml-auto">
                            <button type="button" class="btn btn-sm btn-white dropdown-toggle pl-0 text-secondary"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mx-1">
                                    <i class="fas fa-edit"></i>
                                </span>
                            </button>

                            <div class="dropdown-menu mr-0 pt-0">
                                <a class="dropdown-item bg-teal1 text-white small text-center py-2"
                                    href="{{ route('read_records.create', ['picture_book_id' => $readRecord->picture_book_id]) }}">
                                    <i class="fas fa-book-reader mr-1"></i><b>よんだよ</b>
                                </a>

                                <div class="dropdown-divider mt-0"></div>

                                <a class="dropdown-item small text-center text-teal1"
                                    href="{{ route("read_records.edit", ['read_record' => $readRecord->id]) }}">
                                    <i class="fas fa-pen mr-1"></i>よんだよ編集
                                </a>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item small text-center text-danger" data-toggle="modal"
                                    data-target="#modal-delete-{{ $readRecord->id }}" style="cursor: pointer;">
                                    <i class="fas fa-eraser mr-1"></i>よんだよ削除
                                </a>
                            </div>
                        </div>
                        <!-- dropdown -->

                        <!-- modal -->
                        <div id="modal-delete-{{ $readRecord->id }}" class="modal fade" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="POST"
                                        action="{{ route('read_records.destroy', ['read_record' => $readRecord->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-body">
                                            {{ $readRecord->pictureBook->title }}
                                            の
                                            {{Carbon\Carbon::parse($readRecord->read_date)->format("Y年m月d日") }}
                                            の記録を削除します。よろしいですか？
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

                    <div class="card-text mb-0 d-flex align-items-center flex-wrap">
                        <span class="small text-secondary mb-1">
                            よんだ日：
                        </span>
                        <a href="{{ route("read_records.edit", ['read_record' => $readRecord->id]) }}"
                            class="text-decoration-none mb-1">
                            <span class="small text-dark text-decoration-none ">
                                <b>{{Carbon\Carbon::parse($readRecord->read_date)->format("Y年m月d日") }}</b>
                            </span>
                        </a>
                    </div>

                    {{-- children --}}
                    <div class="card-text mb-0 d-flex align-items-center flex-wrap">
                        @foreach ($readRecord->children as $child)
                        @if ($loop->first)
                        <span class="small text-secondary mb-1">
                            お子さま：
                        </span>
                        @endif
                        <a href="{{ route('children.show', ['id' => $child->id]) }}"
                            class="mr-1  d-flex align-items-center text-decoration-none"
                            title="{{ ($child->birthday !== null) ? Carbon\Carbon::parse($child->birthday)->diff($readRecord->read_date)->format('%y歳') : '' }}">
                            <span class="badge badge-teal1 mb-1">
                                @if (Carbon\Carbon::parse($child->birthday)->lte(Carbon\Carbon::now()->subYear()))
                                <i class="fas fa-child"></i>
                                @else
                                <i class="fas fa-baby"></i>
                                @endif
                                {{ $child->name }}
                            </span>
                        </a>
                        @endforeach
                    </div>

                    <div class="card-text mb-0">
                        <span class="small">
                            {!! nl2br(e($readRecord->memo, false)) !!}
                        </span>
                    </div>

                    {{-- tags --}}
                    <div class="card-text mb-0">
                        @foreach($readRecord->tags as $tag)
                        <a href="{{ route('tags.show', ['name' => $tag->name]) }}"
                            class="p-1 mr-1 mt-1 text-teal1 small">
                            <b>{{ $tag->hashtag }}</b>
                        </a>
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-end text-muted"
                        title="更新日：{{ $readRecord->updated_at->format('Y.m.d') }}">
                        <small>登録日：{{ $readRecord->created_at->format('Y.m.d') }}</small>
                    </div>
                </div>
            </div>
        </div>
</section>
