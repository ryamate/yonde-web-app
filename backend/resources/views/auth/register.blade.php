@extends('app')

@section('title', 'ユーザー登録-よんで-')

@section('content')

@include('auth.nav')

<div class="bg-light">
    <div class="container">
        <div class="row">
            <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6 mt-4" style="margin-bottom: 90px">
                <h2 class="text-center"><a class="text-dark text-decoration-none">よんで の新規登録</a></h2>
                <h4 class="text-center"><b>ようこそ、 よんで へ。</b></h4>
                <div class="card mt-4 p-4 shadow-sm">

                    @include('error_card_list')

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <p style="font-size: 1px;">(<span class="text-danger">*</span>は必須項目です)</p>

                        <div class="form-group">
                            <label for="email">メールアドレス</label><span class="text-danger">*</span>
                            <input class="form-control" type="email" id="email" name="email" placeholder="メールアドレスを入力"
                                required value="{{ old('email') }}">
                        </div>

                        <div class="form-group">
                            <label for="name">よんでID</label><span class="text-danger">*</span>
                            <input class="form-control" type="text" id="name" name="name" placeholder="よんでIDを作成"
                                required value="{{ old('name') }}">
                            <ul class="text-dark small">
                                <li>半角英数小文字：3～16文字</li>
                            </ul>
                        </div>

                        <div class="form-group">
                            <label for="password">パスワード</label><span class="text-danger">*</span>
                            <input class="form-control" type="password" placeholder="パスワードを作成" id="password"
                                name="password" required>
                            <ul class="text-dark small">
                                <li>半角英数・記号：8文字以上</li>
                            </ul>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">パスワード(確認)</label><span class="text-danger">*</span>
                            <input class="form-control" type="password" placeholder="パスワードを確認"
                                id="password_confirmation" name="password_confirmation" required>
                        </div>

                        <button type="submit"
                            class="btn btn-block bg-warning text-decoration-none text-white mt-4"><b>登録</b></button>

                    </form>

                    <div class="card-body px-0">
                        <p class="card-title text-center"><b>または</b></p>
                        <a href="{{ route('login.{provider}', ['provider' => 'google']) }}"
                            class="btn btn-block btn-danger">
                            <i class="fab fa-google mr-4"></i><b>Googleで登録</b>
                        </a>
                    </div>

                    <div class="card-body border-top border-bottom mt-4 px-0">
                        <p class="card-title text-center">アカウントをお持ちの方はこちら</p>
                        <a href="{{ route('login') }}"
                            class="btn btn-block bg-white btn-outline-teal1 text-decoration-none text-teal1"><b>ログイン</b></a>
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
