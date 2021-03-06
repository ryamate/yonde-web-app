@extends('app')

@section('title', 'ユーザー登録-よんで-')

@section('content')

@include('auth.nav')

<div class="bg-paper py-4">
    <div class="container" style="max-width: 540px">
        <h3 class="text-center">
            よんで の新規登録
        </h3>
        <h4 class="text-center">
            <b>ようこそ、 よんで へ。</b>
        </h4>
        <div class="card shadow-sm mb-4 pb-4">
            <div class="card-body">

                @include('error_card_list')

                <form method="POST" action="{{ route('register') }}" data-ajax="false" onSubmit="is_note_msg=false;">
                    @csrf

                    <p class="x-small">
                        (<span class="text-danger">*</span>は必須項目です)
                    </p>

                    <div class="form-group">
                        <label for="email">メールアドレス</label><span class="text-danger">*</span>
                        <input class="form-control" type="email" id="email" name="email" placeholder="メールアドレスを入力"
                            required value="{{ old('email') }}">
                    </div>

                    <div class="form-group">
                        <label for="nickname">ユーザーネーム</label><span class="text-danger">*</span>
                        <input class="form-control" type="text" id="nickname" name="nickname" placeholder="ユーザーネームを入力"
                            required value="{{ old('nickname') }}">
                        <p class="text-muted small ml-1">50文字以内</p>
                    </div>

                    <div class="form-group">
                        <label for="password">パスワード</label><span class="text-danger">*</span>
                        <input class="form-control" type="password" placeholder="パスワードを作成" id="password" name="password"
                            required>
                        <p class="text-muted small ml-1">半角英数・記号：8文字以上</p>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">パスワード(確認)</label><span class="text-danger">*</span>
                        <input class="form-control" type="password" placeholder="パスワードを確認" id="password_confirmation"
                            name="password_confirmation" required>
                    </div>

                    <label for="agree" class="small" role="button">
                        <span class="d-flex flex-wrap">
                            <span>
                                <input type="checkbox" id="agree" required>
                                <a href="{{ route('privacy') }}" class="text-teal1 ml-2" target="_blank"
                                    title="プライバシーポリシーをブラウザの別画面で開く">プライバシーポリシー</a>
                                <span>を確認し、</span>
                            </span>
                            <span>同意</span>
                            <span>
                                <span>
                                    <span>しました。</span><span class="text-danger">*</span>
                                </span>
                            </span>
                    </label>

                    <button type="submit" class="btn btn-block btn-pink text-white mt-4" id="submit" value="submit">
                        <b>登録</b>
                    </button>
                </form>
            </div>

            <div class="card-body pt-0">
                <p class="card-title text-center">
                    <b>または</b>
                </p>
                <a href="{{ route('login.{provider}', ['provider' => 'google']) }}" class="btn btn-block btn-danger">
                    <i class="fab fa-google mr-4"></i><b>Googleで登録</b>
                </a>
            </div>

            <div class="card-body pt-0">
                <p class="card-title border-top d-flex justify-content-center flex-wrap pt-4">
                    <span>アカウントを</span>
                    <span>お持ちの方はこちら</span>
                </p>
                <a href="{{ route('login') }}" class="btn btn-block btn-outline-teal1"><b>ログイン</b></a>
            </div>

            <div class="card-body pt-0">
                <p class="card-title border-top d-flex justify-content-center flex-wrap pt-4">
                    <span>ユーザー登録せずに</span>
                    <span>機能を試したい方はこちら</span>
                </p>
                <a href="{{ route('login.guest') }}" class="btn btn-block btn-outline-mocha">
                    <b>ゲストユーザーログイン</b>
                </a>
            </div>
        </div>
    </div>
</div>

@include('footer')

@endsection
