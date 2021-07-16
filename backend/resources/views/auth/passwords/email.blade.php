@extends('app')

@section('title', 'パスワード再設定-よんで-')

@section('content')

@include('auth.nav')

<div class="bg-paper py-4">
    <div class="container" style="max-width: 540px">
        <h3 class="text-center">
            パスワードを忘れてしまった方へ
        </h3>
        <p style="font-size: 14px;">
            　ログインパスワードを忘れてしまった場合は、パスワード再設定の申請を行ってください。<br>
            　ご登録メールアドレス宛てに、再設定ページの案内をお送りします。</p>
        <div class="card shadow-sm mb-4">
            <div class="card-body">

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
                        <input class="form-control" type="email" id="email" name="email" required
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

@endsection
