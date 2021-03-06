@extends('app')

@section('title', 'お問い合わせ内容の確認 -よんで-')

@section('content')

@include('auth.nav')

<div class="bg-paper py-4">
    <div class="container" style="max-width: 540px">
        <h3 class="text-center">
            お問い合わせ内容の確認
        </h3>
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form method="post" action="{{ route('contact.send') }}">
                    @csrf

                    <div class="form-group">
                        <label for="nickname" class="text-muted">
                            お名前
                        </label>
                        <p>
                            {{ $input['nickname'] }}
                        </p>
                    </div>
                    <div class="form-group">
                        <label for="email" class="text-muted">
                            メールアドレス
                        </label>
                        <p>
                            {{ $input['email'] }}
                        </p>
                    </div>

                    <div class="form-group">
                        <label for="name" class="text-muted">
                            よんでID
                        </label>
                        <p>
                            {{ $input['name'] }}
                        </p>
                    </div>
                    <div class="form-group">
                        <label for="title" class="text-muted">
                            ご用件
                        </label>
                        <p>
                            @if ($input['title'] !== null)
                            {{ $input['title'] }}
                            @else
                            無題
                            @endif
                        </p>
                    </div>

                    <div class="form-group">
                        <label for="body" class="text-muted">
                            お問い合わせ内容
                        </label>
                        <p>
                            {!! nl2br(e($input['body'], false)) !!}
                        </p>
                    </div>

                    <input type="submit" value="送信する" class="btn btn-block btn-teal1 mt-4" />
                    <input name="back" type="submit" value="戻る"
                        class="btn btn-block bg-white btn-outline-secondary text-decoration-none text-secondary mt-4" />
                </form>
            </div>
        </div>
    </div>
</div>

@include('footer')

@endsection
