@extends('app')

@section('title', '招待ユーザー登録-よんで-')

@section('content')

@include('auth.nav')

<div class="bg-paper py-4">
    <div class="container" style="max-width: 540px">
        <h3 class="text-center">
            よんで の新規登録（家族招待用）
        </h3>
        <h4 class="text-center">
            <b>ようこそ、 よんで へ。</b>
        </h4>
        <div class="card my-4 shadow-sm">
            <div class="card-body">

                @include('error_card_list')

                <form method="POST" action="{{ route('register.invited') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="family_id" value="{{ $family_id }}">
                    <input type="hidden" name="email" value="{{ $email }}">

                    <p class="x-small">
                        (<span class="text-danger">*</span>は必須項目です)
                    </p>

                    <div class="form-group">
                        <label for="email">メールアドレス</label>
                        <input class="form-control" type="text" id="email" name="email" value="{{ $email }}" disabled
                            required>
                    </div>

                    <div class="form-group">
                        <label for="nickname">ユーザーネーム</label><span class="text-danger">*</span>
                        <input class="form-control" type="text" id="nickname" name="nickname" placeholder="ユーザーネームを入力"
                            required value="{{ old('nickname') }}">
                        <ul class="text-dark small">
                            <li>50文字以内</li>
                        </ul>
                    </div>

                    <div class="form-group">
                        <label for="password">パスワード</label><span class="text-danger">*</span>
                        <input class="form-control" type="password" placeholder="パスワードを作成" id="password" name="password"
                            required>
                        <ul class="text-dark small">
                            <li>半角英数・記号：8文字以上</li>
                        </ul>
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

                    <button type="submit" class="btn btn-block bg-pink text-decoration-none text-white mt-4">
                        <b>登録</b>
                    </button>

                </form>
            </div>
        </div>
    </div>
</div>

@include('footer')

@endsection
