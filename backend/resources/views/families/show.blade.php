@extends('app')

@section('title', '登録絵本詳細-よんで-')

@section('content')

@include('nav')

<header>
    <div class="bg-light">
        <div class="container" style="max-width: 900px;">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-light small pl-0 mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" class="text-teal1">よんで</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ route('families.index', ['id' => $family->id]) }}"
                            class="text-teal1">{{ $family->name }}ファミリーのタイムライン</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        『{{ $pictureBook->title }}』の記録詳細
                    </li>

                </ol>
            </nav>
        </div>
    </div>
</header>

<div class="bg-light">
    <div class="container">
        <div class="row">
            <div class="container" style="max-width: 900px;">
                <div class="card shadow-sm">
                    @include('families.family_card')
                    @include('families.tabs', [
                    'hasBookshelf' => false,
                    'hasPictureBooks' => false,
                    ])
                </div>
                @include('families.index_tabs', [
                'hasStored' => false,
                'hasReadRecord' => false,
                ])
                @include('families.bookshelf_search_bar')
                <section class="py-4">
                    @include('families.picture_book_card')
                </section>
                <div class="container">
                    @foreach($readRecords as $readRecord)
                    <div class="border-top"></div>
                    <section class="py-4">
                        <div class="card shadow-sm">
                            <div class="row no-gutters">

                                {{-- read record --}}
                                <div class="col-sm-12 d-flex align-items-top">
                                    <div class="card-body pt-3 pb-2">
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
                                            @if (Auth::user()->family_id === $readRecord->pictureBook->family_id)
                                            <!-- dropdown (edit & delete) -->
                                            <div class="btn-group dropleft drop-hover d-flex ml-auto">
                                                <button type="button"
                                                    class="btn btn-sm btn-white dropdown-toggle pl-0 text-secondary"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="mx-1">
                                                        <i class="fas fa-edit"></i>
                                                    </span>
                                                </button>

                                                <div class="dropdown-menu mr-0">
                                                    <a class="dropdown-item small text-center text-teal1"
                                                        href="{{ route("read_records.edit", ['read_record' => $readRecord->id]) }}">
                                                        <i class="fas fa-pen mr-1"></i>よんだよ編集
                                                    </a>

                                                    <div class="dropdown-divider"></div>

                                                    <a class="dropdown-item small text-center text-danger"
                                                        data-toggle="modal"
                                                        data-target="#modal-delete-{{ $readRecord->id }}"
                                                        style="cursor: pointer;">
                                                        <i class="fas fa-eraser mr-1"></i>よんだよ削除
                                                    </a>
                                                </div>
                                            </div>
                                            <!-- dropdown -->

                                            <!-- modal -->
                                            <div id="modal-delete-{{ $readRecord->id }}" class="modal fade"
                                                tabindex="-1" role="dialog">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="閉じる">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="POST"
                                                            action="{{ route('read_records.destroy', ['read_record' => $readRecord->id]) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="modal-body">
                                                                『{{ $readRecord->pictureBook->title }}
                                                                』の「
                                                                {{Carbon\Carbon::parse($readRecord->read_date)->format("Y年m月d日") }}
                                                                」の記録を削除します。よろしいですか？
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <a class="btn btn-outline-grey"
                                                                    data-dismiss="modal">キャンセル</a>
                                                                <button type="submit"
                                                                    class="btn btn-danger">削除する</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- modal -->
                                            @endif
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
                                                    @if(Carbon\Carbon::parse($child->birthday)->lte(Carbon\Carbon::now()->subYear()))
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
                    @endforeach
                    {{ $readRecords->links( 'vendor.pagination.bootstrap-4_teal' ) }}
                </div>
            </div>
        </div>
    </div>
</div>

@include('footer')

@endsection
