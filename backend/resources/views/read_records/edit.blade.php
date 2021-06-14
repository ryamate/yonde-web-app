@extends('app')

@section('title', 'よんだよ編集-よんで-')

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
                    <li class="breadcrumb-item">
                        <a href="{{ route('families.index', ['id' => Auth::user()->family_id]) }}" class="text-teal1">
                            家族のタイムライン
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $pictureBook->title }}
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</header>

<div class="bg-light">
    <div class="container">
        <div class="row">
            <div class="container" style="max-width: 540px;">
                <h2>よんだよ記録の編集</h2>
                <section class="card shadow-sm mb-4">
                    <div class="card-body border-bottom p-0">
                        <div class="row no-gutters">
                            {{-- サムネイル --}}
                            <div class="col-sm-6">
                                <div class="card-body py-0">
                                    <div class="book-cover">
                                        @if ($pictureBook->thumbnail_url !== null)
                                        <img src="{{ $pictureBook->thumbnail_url }}" alt="book-cover"
                                            class="book-cover-image">
                                        @else
                                        <img src="{{ asset('image/no_image.png') }}" alt="No Image"
                                            class="book-cover-image">
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- タイトル, 作者/出版年月 --}}
                            <div class="col-sm-6 d-flex align-items-center justify-content-center">
                                <div class="card-body">
                                    <div class="card-title h5 d-flex justify-content-center">
                                        <b>{{ $pictureBook->title }}</b>
                                    </div>
                                    <div class="card-text small d-flex justify-content-center">
                                        <p>
                                            @if ($pictureBook->authors !== null)
                                            {{ $pictureBook->authors }}/
                                            @endif
                                            @if ($pictureBook->published_date !== null)
                                            {{ $pictureBook->published_date }}発売
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('error_card_list')
                        <div class="card-text">
                            <form method="POST"
                                action="{{ route('read_records.update', ['read_record' => $readRecord->id]) }}">
                                @method('PATCH')
                                @include('read_records.form')
                                <button type="submit" class="btn btn-teal1 shadow-sm btn-block">編集する</button>
                                <input type="hidden" name="picture_book_id" value="{{ $pictureBook->id }}" />
                            </form>
                        </div>
                    </div>
                </section>

                <div class="m-4">
                    <a class="btn btn-block bg-white btn-outline-danger text-decoration-none text-danger"
                        data-toggle="modal" data-target="#modal-delete-{{ $readRecord->id }}">
                        よんだよ記録を削除
                    </a>
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
                                    {{Carbon\Carbon::parse($readRecord->read_date)->format("Y年m月d日") }}の記録を削除します。よろしいですか？
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
            </div>
        </div>
    </div>
</div>
</div>
@endsection
