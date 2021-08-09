@extends('app')

@section('title', 'パスワードの変更-よんで-')

@section('content')

@include('nav')

<div class="bg-paper py-4">
    <div class="container" style="max-width: 540px">
        <h3 class="text-center">
            パスワードの変更
        </h3>

        @if (Auth::id() === config('const.GUEST_USER_ID'))
        <p class="text-danger">※ゲストユーザーは、パスワード変更できません。</p>
        @endif

        <div class="card shadow-sm mb-4">
            <div class="card-body">

                @include('error_card_list')

                <form action="{{ route('users.update_password') }}" method="post">
                    <input type="hidden" name="id" value="{{ $user->id }}" />
                    <input type="hidden" name="name" value="{{ $user->name }}" />
                    <input type="hidden" name="nickname" value="{{ $user->nickname }}" />
                    @csrf

                    <div class="form-group">
                        <label for="current_password">現在のパスワード</label>
                        <input class="form-control" type="password" id="password" name="current_password" required
                            placeholder="現在のパスワードを入力"
                            {{ Auth::id() === config('const.GUEST_USER_ID') ? 'readonly' : '' }}>
                    </div>

                    <div class="form-group">
                        <label for="password">新しいパスワード</label>
                        <input class="form-control" type="password" id="password" name="password" required
                            placeholder="新しいパスワードを作成"
                            {{ Auth::id() === config('const.GUEST_USER_ID') ? 'readonly' : '' }}>
                        <p class="text-muted small ml-1">半角英数・記号：8文字以上</p>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">新しいパスワード(確認)</label>
                        <input class="form-control" type="password" id="password_confirmation"
                            name="password_confirmation" required placeholder="新しいパスワードを確認"
                            {{ Auth::id() === config('const.GUEST_USER_ID') ? 'readonly' : '' }}>
                    </div>

                    @if (Auth::id() !== config('const.GUEST_USER_ID'))
                    <button type="submit" class="btn btn-block btn-teal1 mt-4">
                        <b>変更する</b>
                    </button>
                    @endif
                    <button type="button" onClick="history.back()"
                        class="btn btn-block bg-white btn-outline-teal1 text-decoration-none text-teal1 mt-3">
                        <i class="fas fa-arrow-left mr-1"></i>戻る
                    </button>
                    @if (Auth::id() !== config('const.GUEST_USER_ID'))
                    <div class="card-text text-center mt-2">
                        <a href="{{ route('password.request') }}" class="text-teal1 text-decoration-none small">
                            パスワードを忘れた方
                        </a>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>

@include('footer')

@endsection
