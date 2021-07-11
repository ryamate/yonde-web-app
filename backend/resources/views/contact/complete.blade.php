@extends('app')

@section('title', 'お問い合わせメール送信完了-よんで-')

@section('content')

@include('auth.nav')

<div class="bg-light py-4">
    <div class="container" style="max-width: 540px">
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
