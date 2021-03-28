@extends('app')

@section('title', 'パスワード再設定-Yonde-')

@section('content')
<nav class="navbar navbar-light bg-teal1 shadow-sm bd-navbar justify-content-center"
    style="vertical-align: middle; position: sticky; top: 0; z-index: 1071; background: linear-gradient(-135deg, #22968a, #45d9c8) fixed; opacity: 0.97;">
    <a class="navbar-brand p-0" href="/">
        <img src="{{ asset('image/logo.png') }}" height="45"
            class="d-inline-block align-center text-white text-decoration-none" alt="yonde">
    </a>
</nav>

<div class="bg-light">
    <div class="container">
        <div class="row">
            <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6 mt-4" style="margin-bottom: 90px">
                <h2 class="text-center"><a class="text-dark text-decoration-none">パスワードを忘れてしまった方へ</a></h2>
                <p class="pt-4" style="font-size: 14px;">
                    　ログインパスワードを忘れてしまった場合は、パスワード再設定の申請を行ってください。<br>
                    　ご登録メールアドレス宛てに、再設定ページの案内をお送りします。</p>
                <div class="card mt-4 p-4 shadow-sm">

                    @include('error_card_list')

                    @if (session('status'))
                    <div class="card-text alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">メールアドレス</label>
                            <input class="form-control" type="text" id="email" name="email" required
                                placeholder="メールアドレスを入力" value="{{ old('email') }}">
                            <ul class="text-dark small">
                                <li>ご登録のメールアドレスを入力してください。</li>
                            </ul>
                        </div>

                        <button type="submit"
                            class="btn btn-block bg-white btn-outline-teal1 text-decoration-none text-teal1 mt-4"><b>申請する</b></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('footer')

</div>
@endsection
