@extends('app')

@section('title', 'よんだよ編集-よんで-')

@section('content')

@include('nav')

<header>
    <div class="bg-paper">
        <div class="container" style="max-width: 900px;">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-paper small pl-0 mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" class="text-teal1">よんで</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('families.index', ['name' => Auth::user()->family->name]) }}"
                            class="text-teal1">
                            {{ Auth::user()->family->nickname }}ファミリーのタイムライン
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

<div class="bg-paper pb-4">
    <div class="container" style="max-width: 540px;">
        <h4>よんだよ記録の編集</h4>
        <section class="card shadow-sm mb-4">
            <div class="card-body border-bottom p-0">
                @include('picture_books.thumbnail')
            </div>
            <div class="card-body">
                @include('error_card_list')
                <div class="card-text">
                    <form method="POST" action="{{ route('read_records.update', ['read_record' => $readRecord->id]) }}">
                        @method('PATCH')

                        @include('read_records.form')

                        <button type="submit" class="btn btn-teal1 shadow-sm btn-block">編集完了する</button>
                        <input type="hidden" name="picture_book_id" value="{{ $pictureBook->id }}" />
                    </form>
                </div>
                <div class="card-text">
                    <a href="{{ route('families.read_record', ["name" =>  Auth::user()->family->name]) }}"
                        class="btn btn-block btn-outline-teal1 bg-white text-decoration-none text-teal1 mt-3">
                        <i class="fas fa-chevron-circle-left mr-1"></i>戻る
                    </a>
                </div>
            </div>
        </section>
    </div>
</div>

@include('footer')

@endsection
