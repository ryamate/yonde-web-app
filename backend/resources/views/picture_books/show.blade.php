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
                        <a href="{{ route('picture_books.index') }}" class="text-teal1">よんで</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ route('picture_books.index') }}" class="text-teal1">タイムライン</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $storedPictureBook->pictureBook->title }}
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
                @include('picture_books.card')
            </div>
        </div>
    </div>
</div>
@endsection
