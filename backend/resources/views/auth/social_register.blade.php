@extends('app')

@section('title', 'ユーザー登録-よんで-')

@section('content')

@include('auth.nav')

<div class="bg-light">
    <div class="container">
        <div class="row">
            <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6 mt-4" style="margin-bottom: 90px">
                <h2 class="text-center"><a class="text-dark text-decoration-none">よんで の新規登録</a></h2>
                <h4 class="text-center"><b>ようこそ、 よんで へ。</b></h4>
                <div class="card mt-4 p-4 shadow-sm">

                    @include('error_card_list')

                    <form method="POST" action="{{ route('register.{provider}', ['provider' => $provider]) }}">
                        @csrf

                        <p style="font-size: 1px;">(<span class="text-danger">*</span>は必須項目です)</p>

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group">
                            <label for="yonde_id">よんでID</label><span class="text-danger">*</span>
                            <input class="form-control" type="text" id="yonde_id" name="yonde_id" placeholder="よんでIDを作成"
                                required value="{{ old('yonde_id') }}">
                            <ul class="text-dark small">
                                <li>半角英数小文字：3～16文字</li>
                            </ul>
                        </div>
                        <div class="form-group">
                            <label for="email">メールアドレス</label>
                            <input class="form-control" type="text" id="email" name="email" value="{{ $email }}"
                                disabled>
                        </div>

                        <button type="submit"
                            class="btn btn-block bg-warning text-decoration-none text-white mt-4"><b>登録</b></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('footer')

</div>
@endsection
