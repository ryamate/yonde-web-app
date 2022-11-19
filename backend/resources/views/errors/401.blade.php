@extends('app')

@section('title', '401エラー-よんで-')

@section('content')

@include('nav')

<div class="bg-paper py-4">
    <div class="container text-center" style="max-width: 540px">
        <h3>
            401：Unauthorized
        </h3>
        <div class="alert alert-light" role="alert">
            <div class="py-2">
                <img src="{{ asset('image/index_3-3.png') }}" width="80%">
            </div>
            <h5>
                エラーです…
            </h5>
            <p>
                認証の内容に誤りがないか確認してみてください。
            </p>
        </div>
    </div>
</div>

@include('footer')

@endsection
