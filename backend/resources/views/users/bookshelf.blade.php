@extends('app')

@section('title', $user->name . 'さんの本棚-よんで-')

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
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $user->name }}さんの本棚
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</header>

<div class="bg-light">
    <div class="container">
        <div class="row">
            <div class="container" style="max-width: 900px;"> @include('users.user')
                @include('users.tabs', [
                'hasBookshelf' => true,
                'hasStoredPictureBooks' => false,
                'hasLikes' => false
                ])

                <section class="card shadow-sm my-4">
                    <div class="card-body p-0" style="background-color: #E6D7D2">
                        <div class="row no-gutters">
                            @foreach($storedPictureBooks as $storedPictureBook)
                            <div class="col-4 col-sm-2 d-flex align-items-end">
                                <div class="card border-0" style="background-color: transparent">
                                    <div class="card-body py-0 px-1">
                                        <a
                                            href="{{ route('picture_books.show', ['stored_picture_book' => $storedPictureBook]) }}">
                                            <div class="book-cover">
                                                @if ($storedPictureBook->pictureBook->thumbnail_uri !== null)
                                                <img src="{{ $storedPictureBook->pictureBook->thumbnail_uri }}"
                                                    alt="book-cover" class="book-cover-image">
                                                @else
                                                <img src="{{ asset('image/no_image.png') }}" alt="No Image"
                                                    class="book-cover-image">
                                                @endif
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

@include('footer')

@endsection
