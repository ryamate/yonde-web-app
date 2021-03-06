@extends('app')

@section('title', 'ユーザー登録-Yonde-')

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
                    <h2 class="text-center"><a class="text-dark" href="/">よんで の新規登録</a></h2>
                    <h4 class="text-center"><b>ようこそ、 よんで へ。</b></h4>
                    <div class="card mt-4 p-4 shadow-sm">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <p style="font-size: 1px;">(<span class="text-danger">*</span>は必須項目です)</p>
                            <div class="form-group">
                                <label for="email">メールアドレス</label><span class="text-danger">*</span>
                                <input class="form-control" type="text" id="email" name="email" placeholder="メールアドレスを入力" required value="{{ old('email') }}" >
                            </div>
                            <div class="form-group">
                                <label for="user_name">よんでID</label><span class="text-danger">*</span>
                                <input class="form-control" type="text" id="yonde_id" name="yonde_id" placeholder="よんでIDを作成" required value="{{ old('yonde_id') }}">
                                <ul class="text-dark small">
                                    <li>半角英数小文字：3～16文字</li>
                                </ul>
                            </div>
                            <div class="form-group">
                                <label for="password">パスワード</label><span class="text-danger">*</span>
                                <input class="form-control" type="password" placeholder="パスワードを作成" id="password" name="password" required>
                                <ul class="text-dark small">
                                    <li>半角英数・記号：8文字以上</p>
                                </ul>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">パスワード(確認)</label><span class="text-danger">*</span>
                                <input class="form-control" type="password" placeholder="パスワードを確認" id="password_confirmation" name="password_confirmation" required>
                            </div>
                            <button type="submit" class="btn btn-block bg-warning text-decoration-none text-white"><b>登録</b></button>
                        </form>
                        <div class="card-body border-top border-bottom mt-4">
                            <a href="{{ route('login') }}" class="card-title text-decoration-none text-teal1"><b>ログインはこちら</b></a>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST">
                                <p class="card-title">ユーザー登録せずに機能を試したい方はこちら</p>
                                <button type="submit" class="btn btn-block bg-white btn-outline-teal1 text-decoration-none text-teal1"><b>ゲストユーザーログイン</b></button>
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
