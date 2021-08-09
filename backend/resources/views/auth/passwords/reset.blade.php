@extends('app')

@section('title', 'パスワード再設定-よんで-')

@section('content')

@include('auth.nav')

<div class="bg-paper py-4">
    <div class="container" style="max-width: 540px">
        <h3 class="text-center">
            パスワードの再設定
        </h3>
        <p style="font-size: 14px;">
            　新しいログインパスワードを設定します。
        </p>
        <div class="card shadow-sm mb-4">
            <div class="card-body">

                @include('error_card_list')

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="email" value="{{ $email }}">
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group">
                        <label for="password">新しいパスワード</label>
                        <input class="form-control" type="password" id="password" name="password" required
                            placeholder="パスワードを作成">
                        <p class="text-muted small ml-1">半角英数・記号：8文字以上</p>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">新しいパスワード(確認)</label>
                        <input class="form-control" type="password" id="password_confirmation"
                            name="password_confirmation" required placeholder="パスワードを確認">
                    </div>

                    <button type="submit"
                        class="btn btn-block bg-white btn-outline-teal1 text-decoration-none text-teal1 mt-4">
                        <b>再設定する</b>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('footer')

@endsection
