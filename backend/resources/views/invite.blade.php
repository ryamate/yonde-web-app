@extends('app')

@section('title', '家族招待メール送信-よんで-')

@section('content')

@include('nav')

<div class="bg-light py-4">
    <div class="container" style="max-width: 540px">
        <h3 class="text-center">
            家族招待メール送信
        </h3>
        <p style="font-size: 14px;">
            　本棚の共有するために招待したい、家族のメールアドレスを入力してください。<br>
            　入力したメールアドレス宛てに、招待用のユーザー登録ページの案内をお送りします。
        </p>
        <div class="card my-4 shadow-sm">
            <div class="card-body">

                @include('error_card_list')

                @if (session('status'))
                <div class="card-text alert alert-success">
                    {{ session('status') }}
                </div>
                @endif

                <form method="POST" action="{{ route('invite.email') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email">メールアドレス</label>
                        <input class="form-control" type="email" id="email" name="email" required
                            placeholder="メールアドレスを入力" value="{{ old('email') }}">
                        <ul class="text-dark small">
                            <li>
                                招待したい家族のメールアドレスを入力してください。
                            </li>
                        </ul>
                    </div>

                    <button type="submit"
                        class="btn btn-block bg-white btn-outline-teal1 text-decoration-none text-teal1 mt-4">
                        <b>送信する</b>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('footer')

@endsection
