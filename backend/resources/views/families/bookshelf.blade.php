@extends('app')

@section('title', $family->name . 'ファミリーの本棚-よんで-')

@section('content')

@include('nav')

<header>
    <div class="bg-light">
        <div class="container" style="max-width: 900px;">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-light small pl-0 mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" class="text-teal1">
                            よんで
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $family->name }}ファミリーの本棚
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
                    'hasBookshelf' => true,
                    'hasPictureBooks' => false,
                    // 'hasLikes' => false
                    'hasStored' => false,
                    'hasCurious' => false,
                    'hasRead' => false,
                    ])
                </div>
                @include('families.tabs', [
                'hasBookshelf' => false,
                'hasPictureBooks' => false,
                // 'hasLikes' => false
                'hasStored' => true,
                'hasCurious' => false,
                'hasRead' => false,
                ])
                <section class="card shadow-sm my-4">
                    <div class="card-body p-0" style="background-color: #E6D7D2">
                        <div class="row no-gutters">
                            @foreach($pictureBooks as $pictureBook)
                            <div class="col-4 col-sm-2 d-flex align-items-end">
                                <div class="card border-0" style="background-color: transparent">
                                    <div class="card-body py-0 px-1">
                                        <a href="{{ route('picture_books.show', ['picture_book' => $pictureBook]) }}">
                                            <div class="book-cover">
                                                @if ($pictureBook->thumbnail_url !== null)
                                                <img src="{{ $pictureBook->thumbnail_url }}" alt="book-cover"
                                                    class="book-cover-image">
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
