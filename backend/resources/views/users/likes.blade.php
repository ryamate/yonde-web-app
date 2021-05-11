@extends('app')

@section('title', $user->name . 'さんのいいねした記事')

@section('content')
@include('nav')
<div class="container">
    @include('users.user')
    @include('users.tabs', ['hasStoredPictureBooks' => false, 'hasLikes' => true])
    @foreach($storedPictureBooks as $storedPictureBook)
    @include('picture_books.card')
    @endforeach
</div>
@endsection
