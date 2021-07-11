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
    <div class="container" style="max-width: 900px;">
        <div class="card">
            @include('families.family_card')
            @include('families.tabs', [
            'hasBookshelf' => $hasBookshelf,
            'hasPictureBooks' => $hasPictureBooks,
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

        @foreach($pictureBooks as $pictureBook)
        @if (!$loop->first)
        <div class="border-top"></div>
        @endif
        @include('families.time_line.stored_message')
        @include('families.time_line.stored_card')
        @endforeach
        {{ $pictureBooks->links( 'vendor.pagination.bootstrap-4_teal' ) }}

        @else
        <p class="alert alert-teal1 border text-muted my-4">
            登録はまだありません。
        </p>
        @endif


        @elseif ($hasReadRecord) {{-- よんだよ記録 --}}

        @if (count($readRecords))

        @foreach($readRecords as $readRecord)
        @if (!$loop->first)
        <div class="border-top"></div>
        @endif
        @include('families.time_line.read_message')
        @include('families.time_line.read_card')
        @endforeach
        {{ $readRecords->links( 'vendor.pagination.bootstrap-4_teal' ) }}

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
