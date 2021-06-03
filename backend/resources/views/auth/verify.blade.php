@extends('app')

@section('title', 'ログイン-よんで-')

@section('content')

@include('auth.nav')

<div class="bg-light">
    <div class="container">
        <div class="row">
            <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6 mt-4" style="margin-bottom: 90px">
                <div class="card">
                    <div class="card-header">
                        メールアドレス認証はお済みですか？
                    </div>

                    <div class="card-body">
                        @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            認証メールを再送信しました。
                        </div>
                        @endif

                        このページを閲覧するには、Eメールによる認証が必要です。<br>
                        もし認証用のメールを受け取っていない場合、<br>
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline text-teal1">
                                こちらのリンク
                            </button>
                            をクリックして、認証メールを受け取ってください。
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('footer')

</div>
@endsection
