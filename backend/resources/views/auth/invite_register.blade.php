@extends('app')

@section('title', '招待ユーザー登録-よんで-')

@section('content')

@include('auth.nav')

<div class="bg-light">
    <div class="container">
        <div class="row">
            <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6 mt-4" style="margin-bottom: 90px">
                <h2 class="text-center"><a class="text-dark text-decoration-none">よんで の新規登録（家族招待用）</a></h2>
                <h4 class="text-center"><b>ようこそ、 よんで へ。</b></h4>
                <div class="card mt-4 p-4 shadow-sm">

                    @include('error_card_list')

                    <form method="POST" action="{{ route('register.invited') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">
                        <input type="hidden" name="family_id" value="{{ $family_id }}">
                        <input type="hidden" name="email" value="{{ $email }}">

                        <p style="font-size: 1px;">(<span class="text-danger">*</span>は必須項目です)</p>

                        <div class="form-group">
                            <label for="email">メールアドレス</label>
                            <input class="form-control" type="text" id="email" name="email" value="{{ $email }}"
                                disabled required>
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

                </div>
            </div>
        </div>
    </div>

    @include('footer')

</div>
@endsection
