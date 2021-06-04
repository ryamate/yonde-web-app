@extends('app')

@section('title', 'プロフィール詳細-よんで-')

@section('content')

@include('nav')

<div class="bg-light pb-4">
    <div class="container" style="padding-top: 75px; max-width: 540px;">
        @if (Auth::user()->email_verified_at === null)
        <h2>認証用メールの送信</h2>
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
        @endif

        <h2 class="mt-4 mb-0">プロフィール設定</h2>
        <div class="card p-4 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">よんでID</h5>
                <p class="card-text">{{ $user->name }}</p>
            </div>

            <div class="card-body">
                <h5 class="card-title">ニックネーム</h5>
                <p class="card-text">{{ $user->nickname }}</p>
            </div>

            <div class="card-body">
                <h5 class="card-title">プロフィール画像</h5>
                <p>
                    @if ($user->icon_path)
                    <img src="{{ asset($user->icon_path) }}" alt="プロフィール画像"
                        style="width: 100px; height:100px;background-position: center center;object-fit:cover;">
                    @else
                    <i class="far fa-user-circle fa-5x text-secondary"></i>
                    @endif
                </p>
            </div>

            <div class="card-body">
                <h5 class="card-title">子どもとの関係</h5>
                <p class="card-text">{{ $user->relation }}</p>
            </div>

            @if( Auth::id() === $user->id )
            <a class="btn btn-block bg-white btn-outline-teal1 text-decoration-none text-teal1"
                href="{{ route('users.edit') }}">プロフィールを編集</a>
            @endif
        </div>
    </div>
</div>

@include('footer')

@endsection
