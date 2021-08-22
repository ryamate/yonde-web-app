@extends('app')

@section('title', 'プロフィール設定-よんで-')

@section('content')

@include('nav')

<header>
    <div class="bg-paper">
        <div class="container" style="max-width: 900px;">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-paper small pl-0 mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" class="text-teal1">
                            よんで
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $user->nickname }}さんのプロフィール設定
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</header>

<div class="bg-paper py-4">
    <div class="container" style="max-width: 540px;">
        @if (Auth::user()->email_verified_at === null)
        <div class="mb-4">
            <h4>認証用メールの送信</h4>
            <small>
                新規登録時のメールアドレスの認証用メールを送信します。
            </small>
            <div class="card p-4 shadow-sm">
                @if (session('resent'))
                <div class="alert alert-teal1" role="alert">
                    {{ $user->email }}に認証メールを送信しました！
                </div>
                @endif
                <div class="card-body">
                    <h5 class="card-title">送信するメールアドレス</h5>
                    <p class="card-text text-danger">{{ $user->email }}</p>
                </div>

                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-block btn-teal1">
                        送信する
                    </button>
                </form>
            </div>
        </div>
        @endif

        @if (session('status'))
        <div class="card-text alert alert-success">
            {{ session('status') }}
        </div>
        @endif

        <h4>プロフィール設定</h4>
        @include('families.setting_tabs', [
        'hasUser' => true,
        'hasFamily' => false,
        ])
        <div class="card shadow-sm p-4 mb-4">
            <div class="card-body py-2">
                <p class="card-title text-secondary mb-1">プロフィール画像</p>
                @if ($user->icon_path)
                <img src="{{ asset($user->icon_path) }}" alt="プロフィール画像" class="bg-white border"
                    style="width: 100px; height:100px;background-position: center center; border-radius: 50%; object-fit:cover;">
                @else
                <p class="d-flex align-items-center mb-0">
                    <i class="far fa-user-circle fa-5x text-secondary"></i>
                    <span class="small text-muted ml-1">(未設定)</span>
                </p>
                @endif
            </div>

            <div class="card-body py-2">
                <p class="card-title text-secondary small mb-1">よんでID</p>
                <p class="card-text">{{ $user->name }}</p>
            </div>

            <div class="card-body py-2">
                <p class="card-title text-secondary small mb-1">ユーザーネーム</p>
                <p class="card-text">{{ $user->nickname }}</p>
            </div>

            <div class="card-body pt-2">
                <p class="card-title text-secondary small mb-1">子どもとの関係</p>
                @if ($user->relation !== null)
                <p class="card-text">{{ $user->relation }}</p>
                @else
                <p class="text-muted">(未設定)</p>
                @endif
            </div>

            @if( Auth::id() === $user->id )
            <a class="btn btn-block bg-white btn-outline-teal1 text-decoration-none text-teal1"
                href="{{ route('users.edit') }}">
                プロフィールを編集
            </a>
            @endif
        </div>

        <h4>ログイン設定</h4>
        <div class="card shadow-sm p-4 mb-4">
            <a href="{{ route('users.edit_email') }}"
                class="btn btn-block bg-white btn-outline-teal1 text-decoration-none text-teal1">
                メールアドレスの変更
            </a>

            <a href="{{ route('users.edit_password') }}"
                class="btn btn-block bg-white btn-outline-teal1 text-decoration-none text-teal1">
                パスワードの変更
            </a>
        </div>
        <div class="mx-4">
            <a href="{{ route('users.resign') }}"
                class="btn btn-block bg-white btn-outline-pink text-decoration-none text-pink">
                退会
            </a>
        </div>
    </div>
</div>
</div>

@include('footer')

@endsection
