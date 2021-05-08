@extends('app')

@section('title', 'プロフィール編集-よんで-')

@section('content')

@include('nav')

<div class="bg-light">
    <div class="container">
        <div class="row">
            <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6 mt-4" style="margin-bottom: 90px">
                <h2 class="text-center"><a class="text-dark text-decoration-none">プロフィール編集</a></h2>

                <div class="card mt-4 p-4 shadow-sm">

                    @include('error_card_list')

                    <form class="edit_user" enctype="multipart/form-data" action="{{ route('users.update') }}"
                        accept-charset="UTF-8" method="post">
                        <input name="utf8" type="hidden" value="&#x2713;" />
                        <input type="hidden" name="id" value="{{ $user->id }}" />
                        @csrf
                        <div class="form-group">
                            <label for="user_icon">プロフィール画像</label><br>
                            @if ($user->user_icon)
                            <p>
                                <img src="{{ asset('storage/user_images/' . $user->user_icon) }}" alt="プロフィール画像"
                                    style="width: 100px; height:100px;background-position: center center;object-fit:cover;" />
                            </p>
                            @endif
                            <input type="file" name="user_icon" value="{{ old('user_icon',$user->id) }}"
                                accept="image/jpeg,image/gif,image/png" />
                        </div>

                        <div class="form-group">
                            <label for="yonde_id">よんでID</label>
                            <input autofocus class="form-control" type="text" id="yonde_id"
                                value="{{ old('yonde_id',$user->yonde_id) }}" name="yonde_id" required />
                            <ul class="text-dark small">
                                <li>半角英数小文字：3～16文字</li>
                            </ul>
                        </div>

                        <div class="form-group">
                            <label for="name">ニックネーム</label>
                            <input class="form-control" type="text" id="name" value="{{ old('name',$user->name) }}"
                                name="name" required />
                        </div>

                        <div class="form-group">
                            <label for="introduction">自己紹介文</label>
                            <textarea class="form-control" id="introduction"
                                name="introduction">{{ old('introduction',$user->introduction) }}</textarea>
                            <ul class="text-dark small">
                                <li>1000文字以内 / HTMLタグ使用不可</li>
                            </ul>
                        </div>

                        <div class="form-group">
                            <label for="email">メールアドレス</label>
                            <input class="form-control" type="text" id="email" value="{{ old('email',$user->email) }}"
                                name="email" required />
                        </div>

                        <div class="form-group">
                            <label for="password">パスワード</label>
                            <input class="form-control" type="password" name="password" />
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">パスワードの確認</label>
                            <input class="form-control" type="password" name="password_confirmation" />
                        </div>

                        <button type="submit"
                            class="btn btn-block bg-white btn-outline-teal1 text-decoration-none text-teal1 mt-4"><b>変更する</b></button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('footer')

</div>
@endsection
