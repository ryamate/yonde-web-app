@extends('app')

@section('title', $user->name . 'さんのページ-よんで-')

@section('content')

@include('nav')

<header>
    <div class="bg-light">
        <div class="container" style="max-width: 900px;">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-light small pl-0 mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('picture_books.index') }}" class="text-teal1">
                            よんで
                        </a>
                    </li>
                    @auth
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $user->name }}さんのページ
                    </li>
                    @endauth
                </ol>
            </nav>
        </div>
    </div>
</header>

<div class="bg-light">
    <div class="container">
        <div class="row">
            <div class="container" style="max-width: 900px;">
                @include('users.user')
                @include('users.tabs', ['hasStoredPictureBooks' => true, 'hasLikes' => false])
                @foreach($storedPictureBooks as $storedPictureBook)
                @include('picture_books.card')
                @endforeach
            </div>
        </div>
    </div>
</div>

@include('footer')

@endsection
