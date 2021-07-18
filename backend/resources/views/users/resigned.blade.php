@extends('app')

@section('title', '退会完了-よんで-')

@section('content')

@include('auth.nav')

<div class="bg-paper py-4">
    <div class="container" style="max-width: 540px">
        <h3>
            退会手続き完了
        </h3>
        <p>
            ご利用いただき、ありがとうございました。<br>

        </p>

        <div class="alert alert-teal1" role="alert">
            <h5>
                ご家族のしあわせを願っております！
            </h5>
            <a class="text-decoration-none text-teal1 h6" href="{{ route('home') }}">
                ホーム画面に戻る<i class="fas fa-chevron-circle-right ml-1"></i>
            </a>
        </div>
    </div>
</div>

@include('footer')

@endsection
