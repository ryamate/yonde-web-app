@extends('app')

@section('title', 'パスワード再設定-よんで-')

@section('content')

@include('auth.nav')

<div class="bg-light">
    <div class="container">
        <div class="row">
            <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6 mt-4" style="margin-bottom: 90px">
                <h2 class="text-center"><a class="text-dark text-decoration-none">パスワードの再設定</a></h2>
                <p class="pt-4" style="font-size: 14px;">
                    　新しいログインパスワードを設定します。
                </p>
                <div class="card mt-4 p-4 shadow-sm">

                    @include('error_card_list')

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="email" value="{{ $email }}">
                        <input type="hidden" name="token" value="{{ $token }}">

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

                        <button type="submit"
                            class="btn btn-block bg-white btn-outline-teal1 text-decoration-none text-teal1 mt-4"><b>再設定する</b></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('footer')

</div>
@endsection
