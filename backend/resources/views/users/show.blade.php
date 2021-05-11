@extends('app')

@section('title', $user->name . 'さんのページ-よんで-')

@section('content')

@include('nav')

<div class="container">
    @include('users.user')
    @include('users.tabs', ['hasStoredPictureBooks' => true, 'hasLikes' => false])
    @foreach($storedPictureBooks as $storedPictureBook)
    @include('picture_books.card')
    @endforeach
</div>

@include('footer')

@endsection
