<div class="card shadow-sm mb-4">
    <div class="row no-gutters">
        @if ($hasReadRecord)
        {{-- thumbnail --}}
        <div class="col-sm-2 d-flex justify-content-center align-items-top">
            <a href="{{ route('families.show', [
                        'id' => $family->id,
                        'picture_book' => $readRecord->pictureBook,
                        ]) }}" class="m-3 text-decoration-none">
                <div class="card-img-top book-cover m-auto">
                    @if ($readRecord->pictureBook->thumbnail_url !== null)
                    <img src="{{ $readRecord->pictureBook->thumbnail_url }}" alt="book-cover" class="book-cover-image">
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
        @endif

        {{-- read record --}}
        @if ($hasReadRecord)
        <div class="col-sm-10 d-flex align-items-top">
            @else
            <div class="col-12 d-flex align-items-top">
                @endif

                <div class="card-body pt-3 pb-2">
                    <div class="card-title d-flex align-items-center flex-wrap small mb-0">

                        @if ($hasReadRecord)
                        <a href="{{ route('families.show', [
                        'id' => $family->id,
                        'picture_book' => $readRecord->pictureBook,
                        ]) }}" class="text-teal1 mr-4"
                            title="作者：{{ $readRecord->pictureBook->authors !== null ? $readRecord->pictureBook->authors : '' }}">
                            <b>{{ $readRecord->pictureBook->title }}</b>
                        </a>
                        @else
                        <span class="text-secondary mb-1">
                            よんだ日：
                        </span>
                        <a href="{{ route("read_records.edit", ['read_record' => $readRecord->id]) }}"
                            class="text-decoration-none mb-1">
                            <span class="text-dark text-decoration-none ">
                                <b>{{Carbon\Carbon::parse($readRecord->read_date)->format("Y年m月d日") }}</b>
                            </span>
                        </a>
                        @endif

                        @if (Auth::user()->family_id === $readRecord->pictureBook->family_id)
                        <!-- dropdown (edit & delete) -->
                        <div class="btn-group dropleft drop-hover d-flex ml-auto">
                            <button type="button" class="btn btn-sm btn-white dropdown-toggle pl-0 text-secondary"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mx-1">
                                    <i class="fas fa-edit"></i>
                                </span>
                            </button>

                            @if ($hasReadRecord)
                            <div class="dropdown-menu mr-0 pt-0">
                                <a class="dropdown-item bg-teal1 text-white small text-center py-2"
                                    href="{{ route('read_records.create', ['picture_book_id' => $readRecord->picture_book_id]) }}">
                                    <i class="fas fa-book-reader mr-1"></i><b>よんだよ</b>
                                </a>
                                <div class="dropdown-divider mt-0"></div>
                                @else
                                <div class="dropdown-menu mr-0">
                                    @endif
                                    <a class="dropdown-item small text-center text-teal1"
                                        href="{{ route("read_records.edit", ['read_record' => $readRecord->id]) }}">
                                        <i class="fas fa-pen mr-1"></i>よんだよ編集
                                    </a>

                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item small text-center text-danger" data-toggle="modal"
                                        data-target="#modal-delete-{{ $readRecord->id }}" style="cursor: pointer;">
                                        <i class="fas fa-eraser mr-1"></i>よんだよ削除
                                    </a>
                                    @if ($hasReadRecord)
                                </div>
                                @else
                            </div>
                            @endif
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

                    @if ($hasReadRecord)
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
                    @endif

                    {{-- children --}}
                    <div class="card-text mb-0 d-flex align-items-center flex-wrap">
                        @foreach ($readRecord->children as $child)
                        @if ($loop->first)
                        <span class="small text-secondary mb-1">
                            お子さま：
                        </span>
                        @endif

                        @if ($child->family_id === Auth::user()->family_id)
                        <a href="{{ route('children.show', ['id' => $child->id]) }}"
                            class="mr-1 d-flex align-items-center text-decoration-none"
                            title="{{ ($child->birthday !== null) ? Carbon\Carbon::parse($child->birthday)->diff($readRecord->read_date)->format('%y才(よんだとき)') : '' }}">
                            <span class="badge badge-teal1 mb-1">
                                @if (Carbon\Carbon::parse($child->birthday)->lte(Carbon\Carbon::now()->subYear()))
                                <i class="fas fa-child"></i>
                                @else
                                <i class="fas fa-baby"></i>
                                @endif
                                {{ $child->name }}
                            </span>
                        </a>
                        @else
                        <span class="mr-1 d-flex align-items-center">
                            <span class="badge badge-teal1 mb-1">
                                @if (Carbon\Carbon::parse($child->birthday)->lte(Carbon\Carbon::now()->subYear()))
                                <i class="fas fa-child"></i>
                                @else
                                <i class="fas fa-baby"></i>
                                @endif
                                @if ($child->gender_code === 1)
                                男の子
                                @elseif ($child->gender_code === 2)
                                女の子
                                @else
                                未設定
                                @endif
                            </span>
                        </span>
                        @endif
                        @endforeach
                    </div>

                    <div class="card-text mb-0">
                        <span class="small">
                            {!! nl2br(e($readRecord->memo, false)) !!}
                        </span>
                    </div>

                    {{-- tags --}}
                    <div class="card-text mb-0 d-flex align-items-center flex-wrap">
                        @foreach($readRecord->tags as $tag)
                        <a href="{{ route('tags.show', ['name' => $tag->name]) }}" class="badge text-teal1">
                            <b>{{ $tag->hashtag }}</b>
                        </a>
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-end text-muted"
                        title="更新日：{{ $readRecord->updated_at->format('Y.m.d') }}">
                        <small>登録日：{{ $readRecord->created_at->format('Y.m.d') }}</small>
                    </div>
                </div>

                @if ($hasReadRecord)
            </div>
            @else
        </div>
        @endif

    </div>
</div>
