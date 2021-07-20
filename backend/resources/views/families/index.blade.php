@extends('app')

@section('title', $family->nickname . 'ファミリーのタイムライン-よんで-')

@section('content')

@include('nav')

<header>
    <div class="bg-paper">
        <div class="container" style="max-width: 900px;">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-paper small pl-0 mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" class="text-teal1">
                            よんで
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $family->nickname }}ファミリーのタイムライン
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

        @if (Auth::user()->family_id === $family->id && $storedCount !== 0)
        @include('families.search_bar')
        @endif


        @if ($hasStored) {{-- 登録絵本 --}}

        @if (count($pictureBooks))

        <div
            data-infinite-scroll='{ "path": ".pagination a[rel=next]", "append": ".post", "scrollThreshold": 400, "history": false, "hideNav": ".pagination", "status": ".page-load-status" }'>
            <div class="post">
                @foreach($pictureBooks as $pictureBook)
                @if (!$loop->first)
                <div class="border-top"></div>
                @endif
                @include('families.time_line.stored_picture_books.message')
                @include('families.time_line.stored_picture_books.card')
                @endforeach
            </div>
            <div class="pagination">
                {{ $pictureBooks->links() }}
            </div>
        </div>
        <div class="page-load-status d-flex justify-content-center">
            <div class="infinite-scroll-request spinner-border text-teal1" role="status" style="display:none;">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        @else
        <p class="alert alert-teal1 border text-muted my-4">
            登録はまだありません。
        </p>
        @endif


        @elseif ($hasReadRecord) {{-- よんだよ記録 --}}

        @if (count($readRecords))

        <div
            data-infinite-scroll='{ "path": ".pagination a[rel=next]", "append": ".post", "scrollThreshold": 400, "history": false, "hideNav": ".pagination", "status": ".page-load-status" }'>
            <div class="post">
                @foreach($readRecords as $readRecord)
                @if (!$loop->first)
                <div class="border-top"></div>
                @endif
                @include('families.time_line.read_records.message')
                @include('families.time_line.read_records.card')
                @endforeach
            </div>
            <div class="pagination">
                {{ $readRecords->links() }}
            </div>
        </div>
        <div class="page-load-status d-flex justify-content-center">
            <div class="infinite-scroll-request spinner-border text-teal1" role="status" style="display:none;">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        @else
        <p class="alert alert-teal1 border text-muted my-4">
            記録はまだありません。
        </p>
        @endif

        @endif
    </div>
</div>

@include('footer')

@endsection
