@extends('app')

@section('title', '絵本一覧-よんで-')

@section('content')

@include('nav')

<header>
    <div class="bg-light">
        <div class="container" style="max-width: 900px;">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-light small pl-0 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('picture_books.index') }}" class="text-teal1">よんで</a>
                    </li>
                    @auth
                    <li class="breadcrumb-item active" aria-current="page">みんなのタイムライン</li>
                    @endauth
                </ol>
            </nav>
        </div>
    </div>
</header>

<div class="bg-light">
    <div class="container">
        <div class="row">
            <div class="container" style="max-width: 900px;">
                @if ($pictureBooks !== null)
                {{-- 絵本の記録表示 --}}
                @foreach($pictureBooks as $pictureBook)
                @include('picture_books.card')
                @endforeach
                {{ $pictureBooks->links( 'vendor.pagination.bootstrap-4_teal' ) }}
                @else
                <div class="alert alert-teal1" style="max-width: 360px;">
                    <p>絵本がまだありません。</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@include('footer')

@endsection
