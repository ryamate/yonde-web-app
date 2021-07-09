@extends('app')

@section('title', 'お問い合わせメール送信完了-よんで-')

@section('content')

@include('auth.nav')

<div class="bg-light pb-4">
    <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6 pt-4">
        <h4 class="text-center">お問い合わせ：送信完了</h4>
        <div class="alert alert-info" role="alert">
            <h5>
                お問い合わせメールが送信されました！
            </h5>
            <a class="text-decoration-none text-info" href="{{ route('home') }}">
                ホームへ戻る<i class="fas fa-chevron-circle-right ml-1"></i>
            </a>
        </div>
    </div>
</div>

@include('footer')

@endsection
