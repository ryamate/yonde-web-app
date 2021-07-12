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

<div class="bg-light pb-4">
    <div class="container" style="max-width: 900px;">
        <div class="card">
            @include('families.card')
            @include('families.tabs', [
            'hasBookshelf' => $hasBookshelf,
            'hasPictureBooks' => $hasPictureBooks,
            ])
        </div>
        @include('families.bookshelf.tabs', [
        'hasStored' => $hasStored,
        'hasRead' => $hasRead,
        'hasCurious' => $hasCurious,
        ])

        @if (Auth::user()->family_id === $family->id && $storedCount !== 0)
        @include('families.search_bar')
        @endif

        @if (count($pictureBooks))
        @include('families.bookshelf.card')
        {{ $pictureBooks->links( 'vendor.pagination.bootstrap-4_teal' ) }}

        @else
        <p class="alert border text-muted my-4" style="background-color: #E6D7D2">
            絵本はまだありません。
        </p>
        @endif
    </div>
</div>

@include('footer')

@endsection
