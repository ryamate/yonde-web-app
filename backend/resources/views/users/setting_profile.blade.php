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
            <h3>認証用メールの送信</h3>
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

        <h3>プロフィール設定</h3>
        @include('families.setting_tabs', [
        'hasUser' => true,
        'hasFamily' => false,
        ])
        <div class="card p-4 shadow-sm">
            <div class="card-body py-2">
                <p class="card-title text-secondary mb-1">プロフィール画像</p>
                @if ($user->icon_path)
                <img src="{{ asset($user->icon_path) }}" alt="プロフィール画像" class="bg-white border"
                    style="width: 100px; height:100px;background-position: center center; border-radius: 50%; object-fit:cover;">
                @else
                <p class="d-flex align-items-center mb-0">
                    <i class="far fa-user-circle fa-5x text-secondary"></i>
                    <span class="badge">未設定</span>
                </p>
                @endif
            </div>

            <div class="card-body py-2">
                <p class="card-title text-secondary mb-1">よんでID</p>
                <h5 class="card-text">{{ $user->name }}</h5>
            </div>

            <div class="card-body py-2">
                <p class="card-title text-secondary mb-1">ニックネーム</p>
                <h5 class="card-text">{{ $user->nickname }}</h5>
            </div>

            <div class="card-body py-2">
                <p class="card-title text-secondary mb-1">子どもとの関係</p>
                <h5 class="card-text">{{ $user->relation }}</h5>
            </div>

            @if( Auth::id() === $user->id )
            <a class="btn btn-block bg-white btn-outline-teal1 text-decoration-none text-teal1"
                href="{{ route('users.edit') }}">
                プロフィールを編集
            </a>
            @endif
        </div>
    </div>
</div>
</div>

@include('footer')

@endsection
