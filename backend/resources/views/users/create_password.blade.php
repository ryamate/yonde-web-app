@extends('app')

@section('title', 'パスワード設定-よんで-')

@section('content')

@include('auth.nav')

<div class="bg-paper py-4">
    <div class="container" style="max-width: 540px">
        <h3 class="text-center">
            パスワードの設定
        </h3>
        <p style="font-size: 14px;">
            　新しいログインパスワードを設定します。
        </p>

        @if (session('status'))
        <div class="card-text alert alert-success">
            {{ session('status') }}
        </div>
        @endif

        <div class="card shadow-sm mb-4">
            <div class="card-body">

                @include('error_card_list')

                <form method="POST" action="{{ route('users.store_password') }}">
                    @csrf

                    <input type="hidden" name="id" value="{{ $user->id }}">

                    <div class="form-group">
                        <label for="password">新しいパスワード</label>
                        <input class="form-control" type="password" id="password" name="password" required
                            placeholder="パスワードを作成">
                        <ul class="text-dark small">
                            <li>半角英数・記号：8文字以上</li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">新しいパスワード(確認)</label>
                        <input class="form-control" type="password" id="password_confirmation"
                            name="password_confirmation" required placeholder="パスワードを確認">
                    </div>

                    <button type="submit" class="btn btn-block btn-teal1 mt-4">
                        <b>設定する</b>
                    </button>
                    <button type="button" onClick="history.back()"
                        class="btn btn-block bg-white btn-outline-teal1 text-decoration-none text-teal1 mt-3">
                        <i class="fas fa-arrow-left mr-1"></i>戻る
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('footer')

@endsection
