@extends('app')

@section('title', 'ログイン-よんで-')

@section('content')

@include('auth.nav')

<div class="bg-light">
    <div class="container">
        <div class="row">
            <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6 mt-4" style="margin-bottom: 90px">
                <h2 class="text-center"><a class="text-dark text-decoration-none">ログイン</a></h2>
                <p class="pt-4" style="font-size: 14px;">
                    　よんで に登録している方は、下記からログインしてください。<br>
                    　まだ登録していない方は<a class="text-decoration-none text-teal1"
                        href="{{ route('register') }}">こちらから登録</a>してください。</p>
                <div class="card mt-4 p-4 shadow-sm">

                    @include('error_card_list')

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">メールアドレス</label>
                            <input class="form-control" type="text" id="email" name="email" required
                                placeholder="メールアドレスを入力" value="{{ old('email') }}">
                        </div>
                        <div class="form-group">
                            <label for="password">パスワード</label>
                            <input class="form-control" type="password" id="password" name="password" required
                                placeholder="パスワードを入力">
                        </div>

                        <input type="hidden" name="remember" id="remember" value="on">

                        <button type="submit"
                            class="btn btn-block bg-white btn-outline-teal1 text-decoration-none text-teal1 mt-4"><b>ログイン</b></button>

                        <div class="text-center mt-2">
                            <a href="{{ route('password.request') }}"
                                class="card-text text-teal1 text-decoration-none small">パスワードを忘れた方</a>
                        </div>
                    </form>

                    <div class="card-body px-0">
                        <p class="card-title text-center"><b>または</b></p>
                        <a href="{{ route('login.{provider}', ['provider' => 'google']) }}"
                            class="btn btn-block btn-danger">
                            <i class="fab fa-google mr-4"></i><b>Googleでログイン</b>
                        </a>
                    </div>

                    <div class="card-body border-top border-bottom mt-4 px-0">
                        <p class="card-title text-center"><b>アカウントをお持ちでない方はこちら</b></p>
                        <a href="{{ route('register') }}"
                            class="btn btn-block btn-warning  text-decoration-none text-white"><b>新規登録</b></a>
                    </div>

                    <div class="card-body px-0">
                        <p class="card-title text-center">ユーザー登録せずに機能を試したい方はこちら</p>
                        <a href="{{ route('login.guest') }}"
                            class="btn btn-block bg-white btn-outline-secondary text-decoration-none text-secondary">
                            <b>ゲストユーザーログイン</b>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('footer')

</div>
@endsection
