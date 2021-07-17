@extends('app')

@section('title', $tag->hashtag . '-よんで-')

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
                    @auth
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $tag->hashtag }}
                    </li>
                    @endauth
                </ol>
            </nav>
        </div>
    </div>
</header>

<div class="bg-paper pb-4">
    <div class="container" style="max-width: 900px;">
        <div class="card">
            @include('tags.card')
            @include('tags.tabs', [
            'hasTimeLine' => $hasTimeLine,
            ])
        </div>

        @if ($hasTimeLine) {{-- タイムライン --}}
        @include('tags.time_line.main')
        @endif
    </div>
</div>

@include('footer')

@endsection
