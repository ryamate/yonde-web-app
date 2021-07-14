@extends('app')

@section('title', $user->nickname . 'さんのページ-よんで-')

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
                    @auth
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $user->nickname }}さんのページ
                    </li>
                    @endauth
                </ol>
            </nav>
        </div>
    </div>
</header>

<div class="bg-light pb-4">
    <div class="container" style="max-width: 900px;">
        <div class="card">
            @include('users.card')
            @include('users.tabs', [
            'hasFollows' => $hasFollows,
            'hasTimeLine' => $hasTimeLine,
            ])
        </div>

        @if ($hasFollows) {{-- 本棚フォロー --}}
        @include('users.follows.main')
        @elseif ($hasTimeLine) {{-- タイムライン --}}
        @include('users.time_line.main')
        @endif

    </div>
</div>

@include('footer')

@endsection
