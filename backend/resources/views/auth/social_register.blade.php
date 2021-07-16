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
                        <label for="name">よんでID</label><span class="text-danger">*</span>
                        <input class="form-control" type="text" id="name" name="name" placeholder="よんでIDを作成" required
                            value="{{ old('name') }}">
                        <ul class="text-dark small">
                            <li>半角英数小文字：3～16文字</li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <label for="email">メールアドレス</label>
                        <input class="form-control" type="email" id="email" name="email" value="{{ $email }}" disabled>
                    </div>

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
