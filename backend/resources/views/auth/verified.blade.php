@extends('app')

@section('title', '登録完了-よんで-')

@section('content')

@include('auth.nav')

<div class="bg-light">
    <div class="container">
        <div class="row">
            <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6 mt-4" style="margin-bottom: 90px">
                <h2>新規登録：登録完了</h2>
                <div class="alert alert-warning" role="alert">
                    <h4>
                        メールアドレス認証されました！
                    </h4>
                    <p>
                        あなたの本棚のご用意ができました。<br>
                        まずは好きな絵本を本棚に入れてみよう。
                    </p>
                    <a class="text-decoration-none text-warning h5" href="{{ route('home') }}">
                        ログインする<i class="fas fa-chevron-circle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>

    @include('footer')

</div>
@endsection
