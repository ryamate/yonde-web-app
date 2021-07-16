@extends('app')

@section('title', 'ユーザー登録-よんで-')

@section('content')

@include('auth.nav')

<div class="bg-paper py-4">
    <div class="container" style="max-width: 540px">
        <h3>
            新規登録
        </h3>
        <p>
            登録メールアドレス宛てにメールアドレス認証のメールを送信しました。<br>
            メールの内容をご確認の上、メールアドレス認証を行ってください。<br>
            メールアドレス認証は、よんでからの大切なおしらせメールなどを正確にお届けするために必要です。
        </p>

        <div class="alert alert-teal1" role="alert">
            <h5>
                メールアドレス認証してください。
            </h5>
            <p>
                登録メールアドレス宛てに送信したメールを確認の上、メールアドレス認証を行ってください。
            </p>
            <a class="text-decoration-none text-teal1 h6" href="{{ route('home') }}">
                このままでログインする<i class="fas fa-chevron-circle-right ml-1"></i>
            </a>
        </div>
    </div>
</div>

@include('footer')

@endsection
