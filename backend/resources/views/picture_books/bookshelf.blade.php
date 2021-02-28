@extends('app')

@section('title', '絵本一覧-Yonde-')

@section('content')
@include('nav')
  <div class="container">
    @foreach($stored_picture_books as $stored_picture_book)
    <div class="card mt-3">
      <div class="card-body d-flex flex-row">
        <i class="fas fa-user-circle fa-3x mr-1"></i>
        <div>
          <div class="font-weight-bold">
            {{ $stored_picture_book->user->name }}
          </div>
          <div class="font-weight-lighter">
            {{ $stored_picture_book->created_at->format('Y/m/d H:i') }}
          </div>
        </div>
      </div>
      <div class="card-body pt-0 pb-2">
        <h3 class="h4 card-title">
          {{ $stored_picture_book->title }}
        </h3>
        <div class="card-text">
          {!! nl2br(e( $stored_picture_book->body )) !!}
        </div>
      </div>
    </div>
    @endforeach
  </div>
@endsection
