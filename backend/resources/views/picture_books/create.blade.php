@extends('app')

@section('title', '絵本登録-Yonde-')

@include('nav')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card mt-3">
                <div class="card-body pt-0">
                    @include('error_card_list')
                    <div class="card-text">
                        <form method="POST" action="{{ route('picture_books.store') }}">
                            @include('picture_books.form')
                            <button type="submit" class="btn blue-gradient btn-block">登録する</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
