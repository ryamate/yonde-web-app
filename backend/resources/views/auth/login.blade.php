@extends('app')

@section('title', 'ログイン-Yonde-')

@section('content')
    <nav class="navbar navbar-light bg-teal1 shadow-sm bd-navbar justify-content-center" style="vertical-align: middle; position: sticky; top: 0; z-index: 1071; background: linear-gradient(-135deg, #22968a, #45d9c8) fixed; opacity: 0.97;">
        <a class="navbar-brand p-0" href="/">
            <img src="image/logo.png" height="45" class="d-inline-block align-center text-white text-decoration-none" alt="yonde">
        </a>
    </nav>

    <div class="bg-light">
        <div class="container">
            <div class="row">
                <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6 mt-4" style="margin-bottom: 90px">
                    <h2 class="text-center"><a class="text-dark text-decoration-none">ログイン</a></h2>
                    <p class="text-center pt-4"style="font-size: 14px;">
                        よんで に登録している方は、下記からログインしてください。<br>
                        まだ登録していない方は<a class="text-decoration-none text-info" href="{{ route('register') }}">こちらから登録</a>してください。</p>
                    <div class="card mt-4 p-4 shadow-sm">

                        @include('error_card_list')

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email">メールアドレス</label>
                                <input class="form-control" type="text" id="email" name="email" placeholder="メールアドレスを入力" required value="{{ old('email') }}" >
                            </div>
                            <div class="form-group">
                                <label for="password">パスワード</label>
                                <input class="form-control" type="password" placeholder="パスワードを作成" id="password" name="password" required>
                            </div>

                            <input type="hidden" name="remember" id="remember" value="on">

                            <button type="submit" class="btn btn-block bg-white btn-outline-info text-decoration-none text-info mt-4"><b>ログイン</b></button>
                        </form>

                        <div class="card-body border-top border-bottom mt-4 px-0">
                            <p class="card-title">アカウントをお持ちでない方はこちら</p>
                            <a href="{{ route('register') }}" class="btn btn-block btn-warning  text-decoration-none text-white"><b>新規登録</b></a>
                        </div>
                        <div class="card-body px-0">
                            <form action="" method="POST">
                                <p class="card-title">ユーザー登録せずに機能を試したい方はこちら</p>
                                <button type="submit" class="btn btn-block bg-white btn-outline-secondary text-decoration-none text-secondary"><b>ゲストユーザーログイン</b></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer mt-auto py-4">
            <div class="container">
                <!-- <span class="text-muted">Place sticky footer content here.</span> -->
                <span class="d-flex justify-content-center flex-wrap small">
                    <a href="/" class="btn btn-sm text-teal1"><b>よんで-Yonde-</b></a>
                    <a href="/about" class="btn btn-sm text-teal1"><b>よんで-Yonde-について</b></a>
                    <a href="" class="btn btn-sm text-teal1"><b>利用規約</b></a>
                    <a href="" class="btn btn-sm text-teal1"><b>プライバシーポリシー</b></a>
                    <a href="/contact" class="btn btn-sm text-teal1"><b>お問い合わせ</b></a>
                </span>
                <span class="d-flex justify-content-center flex-wrap text-muted small">
                    <address class="small">Copyright &copy; 2021 Ryuzo Yamate All Rights Reserved.</address>
                </span>
            </div>
        </footer>
    </div>
@endsection
