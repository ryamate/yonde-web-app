@extends('app')

@section('title', '404エラー-よんで-')

@section('content')

@include('nav')

<div class="bg-paper py-4">
    <div class="container text-center" style="max-width: 540px">
        <h3>
            404：Not Found
        </h3>
        <div class="alert alert-light" role="alert">
            <div class="py-2">
                <img src="{{ asset('image/index_3-3.png') }}" width="80%">
            </div>
            <h5>
                エラーです…
            </h5>
            <p>
                ページが見つかりませんでした。
            </p>
        </div>
    </div>
</div>

@include('footer')

@endsection
