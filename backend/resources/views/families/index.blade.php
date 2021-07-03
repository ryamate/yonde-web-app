@extends('app')

@section('title', $family->name . 'ファミリーのページ-よんで-')

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
                        {{ $family->name }}ファミリーのタイムライン
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</header>

<div class="bg-light pb-4">
    <div class="container">
        <div class="row">
            <div class="container" style="max-width: 900px;">
                <div class="card shadow-sm">
                    @include('families.family_card')
                    @include('families.tabs', [
                    'hasBookshelf' => false,
                    'hasPictureBooks' => true,
                    ])
                </div>
                @include('families.index_tabs', [
                'hasStored' => true,
                'hasReadRecord' => false,
                ])
                @include('families.bookshelf_search_bar')
                @foreach($pictureBooks as $pictureBook)
                @include('picture_books.card')
                @endforeach
                {{ $pictureBooks->links( 'vendor.pagination.bootstrap-4_teal' ) }}
            </div>
        </div>
    </div>
</div>

@include('footer')

@endsection
