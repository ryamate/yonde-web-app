@extends('app')

@section('title', 'お問い合わせ -よんで-')

@section('content')

@include('auth.nav')

<div class="bg-light">
    <div class="container">
        <div class="row">
            <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6 mt-4" style="margin-bottom: 90px">
                <h3 class="text-center">
                    お問い合わせ
                </h3>
                <p class="pt-4" style="font-size: 14px;">
                    　よんでに対するご意見・ご感想・お問い合わせなどございましたらお聞かせください。<br>
                    　お送りいただいた内容はすべて確認しておりますが、ご返信を差し上げることができない場合もございますので、ご了承ください。
                </p>
                <div class="card mt-4 p-4 shadow-sm">

                    @include('error_card_list')

                    @if (session('status'))
                    <div class="card-text alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form method="post" action="{{ route('contact.post') }}">
                        @csrf

                        <p class="small">
                            (<span class="text-danger">*</span>は必須項目です)
                        </p>

                        <div class="form-group">
                            <label for="nickname">お名前</label>
                            <span class="text-danger">*</span>
                            <input class="form-control" type="text" id="nickname" name="nickname" required
                                value="{{ Auth::user()->nickname ?? old('nickname') }}">
                        </div>
                        <div class="form-group">
                            <label for="email">メールアドレス</label>
                            <span class="text-danger">*</span>
                            <input class="form-control" type="email" id="email" name="email" required
                                value="{{ Auth::user()->email ?? old('email') }}">
                        </div>

                        <div class="form-group">
                            <label for="name">よんでID（ログインID）</label>
                            <input class="form-control" type="text" id="name" name="name"
                                value="{{ Auth::user()->name ?? old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="title">ご用件</label>
                            <input class="form-control" type="title" id="title" name="title" value="{{ old('title') }}">
                        </div>

                        <div class="form-group">
                            <label for="body">お問い合わせ内容</label>
                            <span class="text-danger">*</span>
                            <textarea type="text" name="body" id="body" rows="5" class="form-control"
                                required>{{ old('body') }}</textarea>
                            <ul class="text-dark small">
                                <li>1000文字以内</li>
                            </ul>
                        </div>

                        <button type="submit"
                            class="btn btn-block bg-white btn-outline-teal1 text-decoration-none text-teal1 mt-4">
                            <b>送信内容を確認する</b>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('footer')

@endsection
