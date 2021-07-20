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
        <div class="card shadow-sm mb-4">
            <div class="card-body">

                @include('error_card_list')

                <form method="POST" action="{{ route('register.{provider}', ['provider' => $provider]) }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <p class="x-small">
                        (<span class="text-danger">*</span>は必須項目です)
                    </p>

                    <div class="form-group">
                        <label for="nickname">ユーザーネーム</label><span class="text-danger">*</span>
                        <input class="form-control" type="text" id="nickname" name="nickname" placeholder="ユーザーネームを入力"
                            required value="{{ old('nickname') }}">
                        <ul class="text-dark small">
                            <li>～50文字</li>
                        </ul>
                    </div>

                    <div class="form-group">
                        <label for="email">メールアドレス</label>
                        <input class="form-control" type="email" id="email" name="email" value="{{ $email }}" disabled>
                    </div>

                    <input type="checkbox" id="agree" required>
                    <label for="agree" class="small" role="button">
                        プライバシーポリシーを<a href="{{ route('privacy') }}" class="text-teal1" target="_blank"
                            title="プライバシーポリシーをブラウザの別画面で開く">確認</a>し、同意しました。<span class="text-danger">*</span>
                    </label>

                    <button type="submit" class="btn btn-block bg-warning text-decoration-none text-white mt-4">
                        <b>登録</b>
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>

@include('footer')

@endsection
