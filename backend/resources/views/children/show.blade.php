@extends('app')

@section('title', 'お子さまのページ-よんで-')

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
                        @if ($child->family_id === Auth::user()->family_id)
                        {{ $child->name }}（お子さま）のページ
                        @else
                        お子さまのページ
                        @endif
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
            @include('children.card')
            @include('children.tabs', [
            'hasTimeLine' => $hasTimeLine,
            ])
        </div>

        @if ($hasTimeLine) {{-- タイムライン --}}
        @include('children.time_line.main')
        @endif

    </div>
</div>

@include('footer')

@endsection
