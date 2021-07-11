@extends('app')

@section('title', '登録完了-よんで-')

@section('content')

@include('auth.nav')

<div class="bg-light py-4">
    <div class="container" style="max-width: 540px">
        <h3>
            新規登録：登録完了
        </h3>
        <div class="alert alert-warning" role="alert">
            <h5>
                メールアドレス認証されました！
            </h5>
            <p>
                あなたの本棚のご用意ができました。<br>
                まずは好きな絵本を本棚に入れてみよう。
            </p>
            <a class="text-decoration-none text-warning h6" href="{{ route('home') }}">
                ログインする<i class="fas fa-chevron-circle-right ml-1"></i>
            </a>
        </div>

    </div>
</div>

@include('footer')

@endsection
