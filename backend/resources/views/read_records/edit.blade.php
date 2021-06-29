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
                            {{ Auth::user()->family->name }}ファミリーのタイムライン
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

<div class="bg-light pb-4">
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

                        <button type="submit" class="btn btn-outline-teal1 shadow-sm btn-block">編集完了する</button>
                        <input type="hidden" name="picture_book_id" value="{{ $pictureBook->id }}" />
                    </form>
                </div>
                <div class="card-text">
                    <a href="{{ route('families.read_record', ["id" =>  Auth::user()->family->id]) }}"
                        class="btn btn-block btn-outline-secondary bg-white text-decoration-none text-secondary mt-4">
                        <i class="fas fa-chevron-circle-left mr-1"></i>戻る
                    </a>
                </div>
            </div>
        </section>
    </div>
</div>

@include('footer')

@endsection
