@extends('app')

@section('title', 'ユーザー再登録-よんで-')

@section('content')

@include('auth.nav')

<div class="bg-paper py-4">
    <div class="container" style="max-width: 540px">
        <h3>
            再登録完了
        </h3>
        <div class="alert alert-latte" role="alert">
            <h5>
                おかえりなさいませ！
            </h5>
            <p>
                あなたの本棚のご用意ができました。<br>
                まずは好きな絵本を本棚に入れてみよう。
            </p>
            <a class="text-decoration-none text-mocha h6" href="{{ route('home') }}">
                ログインする<i class="fas fa-chevron-circle-right ml-1"></i>
            </a>
        </div>
    </div>
</div>

@include('footer')

@endsection
