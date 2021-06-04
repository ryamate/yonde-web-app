@extends('app')

@section('title', 'ユーザー登録-よんで-')

@section('content')

@include('auth.nav')

<div class="bg-light">
    <div class="container">
        <div class="row">
            <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6 mt-4" style="margin-bottom: 90px">
                <h2>新規登録</h2>
                <p>
                    登録メールアドレス宛てにメールアドレス認証のメールを送信しました。<br>
                    メールの内容をご確認の上、メールアドレス認証を行ってください。<br>
                    メールアドレス認証は、よんでからの大切なおしらせメールなどを正確にお届けするために必要です。
                </p>

                <div class="alert alert-teal1" role="alert">
                    <h4>
                        メールアドレス認証してください。
                    </h4>
                    <p>
                        登録メールアドレス宛てに送信したメールを確認の上、メールアドレス認証を行ってください。
                    </p>
                    <a class="text-decoration-none text-teal1 h5" href="{{ route('picture_books.home') }}">
                        このままでログインする<i class="fas fa-chevron-circle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>

    @include('footer')

</div>
@endsection
