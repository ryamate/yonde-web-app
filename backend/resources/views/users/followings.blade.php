@extends('app')

@section('title', $user->name . 'さんのフォロー中-よんで-')

@section('content')

@include('nav')

<header>
    <div class="bg-light">
        <div class="container" style="max-width: 900px;">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-light small pl-0 mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('picture_books.index') }}" class="text-teal1">
                            よんで
                        </a>
                    </li>
                    @auth
                    <li class="breadcrumb-item">
                        <a href="{{ route("users.show", ["yonde_id" => $user->yonde_id]) }}" class="text-teal1">
                            {{ $user->name }}さんのページ
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $user->name }}さんのフォロー中
                    </li>
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
                @include('users.user')
                @include('users.tabs', [
                'hasBookshelf' => false,
                'hasPictureBooks' => false,
                'hasLikes' => false,
                'hasFollowers' => false,
                'hasFollowings' => true,
                ])
                @foreach($followings as $person)
                @include('users.person')
                @endforeach
            </div>
        </div>
    </div>
</div>

@include('footer')

@endsection
