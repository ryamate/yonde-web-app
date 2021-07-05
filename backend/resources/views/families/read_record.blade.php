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

<div class="bg-light">
    <div class="container">
        <div class="row">
            <div class="container" style="max-width: 900px;">
                <div class="card">
                    @include('families.family_card')
                    @include('families.tabs', [
                    'hasBookshelf' => false,
                    'hasPictureBooks' => true,
                    ])
                </div>
                @include('families.index_tabs', [
                'hasStored' => false,
                'hasReadRecord' => true,
                ])
                @include('families.bookshelf_search_bar')
                @foreach($readRecords as $readRecord)
                @if (!$loop->first)
                <div class="border-top"></div>
                @endif
                @include('read_records.card')
                @endforeach
                {{ $readRecords->links( 'vendor.pagination.bootstrap-4_teal' ) }}
            </div>
        </div>
    </div>
</div>

@include('footer')

@endsection
