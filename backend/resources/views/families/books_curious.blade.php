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
                    ])
                </div>
                @include('families.bookshelf_tabs', [
                'hasStored' => false,
                'hasRead' => false,
                'hasCurious' => true,
                ])
                @include('families.bookshelf_search_bar')
                @include('families.bookshelf_card')
            </div>
        </div>
    </div>
</div>

@include('footer')

@endsection
