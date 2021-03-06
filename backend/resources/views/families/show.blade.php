@extends('app')

@section('title', '登録絵本詳細-よんで-')

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
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ route('families.index', ['name' => $family->name]) }}"
                            class="text-teal1">{{ $family->nickname }}ファミリーのタイムライン</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        『{{ $pictureBook->title }}』の記録詳細
                    </li>

                </ol>
            </nav>
        </div>
    </div>
</header>

<div class="bg-paper pb-4">
    <div class="container" style="max-width: 900px;">
        <div class="card">
            @include('families.card')
            @include('families.tabs', [
            'hasBookshelf' => $hasBookshelf,
            'hasTimeLine' => $hasTimeLine,
            ])
        </div>
        @include('families.time_line.tabs', [
        'hasStored' => $hasStored,
        'hasReadRecord' => $hasReadRecord,
        ])
        @if (Auth::user()->family_id === $family->id)
        @include('families.search_bar')
        @endif

        <section class="my-4">
            @include('families.time_line.stored_picture_books.card')
        </section>

        <div class="container">
            @foreach($readRecords as $readRecord)
            <div class="border-top"></div>
            <section class="my-4">
                @include('families.time_line.read_records.card')
            </section>
            @endforeach
            {{ $readRecords->links( 'vendor.pagination.bootstrap-4_teal' ) }}
        </div>
    </div>
</div>

@include('footer')

@endsection
