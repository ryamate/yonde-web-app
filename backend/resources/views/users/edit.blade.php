@extends('app')

@section('title', 'プロフィール編集-よんで-')

@section('content')

@include('nav')

<div class="bg-paper py-4">
    <div class="container" style="max-width: 540px">
        <h3 class="text-center">
            プロフィール編集
        </h3>

        @if (Auth::id() === config('const.GUEST_USER_ID'))
        <p class="text-danger">※ゲストユーザーは、プロフィール編集できません。</p>
        @endif

        <div class="card shadow-sm mb-4">
            <div class="card-body">

                @include('error_card_list')

                <form enctype="multipart/form-data" action="{{ route('users.update') }}" accept-charset="UTF-8"
                    method="post">
                    <input name="utf8" type="hidden" value="&#x2713;" />
                    <input type="hidden" name="id" value="{{ $user->id }}" />
                    <input type="hidden" name="email" value="{{ $user->email }}" />
                    @csrf
                    <div class="form-group">
                        <label for="icon_path">プロフィール画像</label><br>
                        @if ($user->icon_path)
                        <p>
                            <img src="{{ asset($user->icon_path) }}" alt="プロフィール画像"
                                style="width: 100px; height:100px;background-position: center center;object-fit:cover;" />
                        </p>
                        @endif
                        <input type="file" name="image" value="{{ old('image',$user->id) }}"
                            accept="image/jpeg,image/gif,image/png" />
                    </div>

                    <div class="form-group">
                        <label for="name">よんでID</label>
                        <input autofocus class="form-control" type="text" id="name"
                            value="{{ old('name',$user->name) }}" name="name" required
                            {{ Auth::id() === config('const.GUEST_USER_ID') ? 'readonly' : '' }} />
                        <ul class="text-dark small">
                            <li>半角英数小文字：3～16文字</li>
                        </ul>
                    </div>

                    <div class="form-group">
                        <label for="nickname">ニックネーム</label>
                        <input class="form-control" type="text" id="nickname"
                            value="{{ old('nickname',$user->nickname) }}" name="nickname" required
                            {{ Auth::id() === config('const.GUEST_USER_ID') ? 'readonly' : '' }} />
                    </div>

                    <div class="form-group">
                        <label for="relation">子どもとの関係</label>
                        <input class="form-control" type="text" id="relation"
                            value="{{old('relation',$user->relation) }}" name="relation"
                            {{ Auth::id() === config('const.GUEST_USER_ID') ? 'readonly' : '' }} />
                    </div>

                    @if (Auth::id() !== config('const.GUEST_USER_ID'))
                    <button type="submit" class="btn btn-block btn-teal1  mt-4"><b>変更する</b></button>
                    @endif
                    <a href="{{ route('users.setting_profile') }}"
                        class="btn btn-block bg-white btn-outline-teal1 text-decoration-none text-teal1 mt-3">
                        <i class="fas fa-angle-double-left mr-1"></i>戻る
                    </a>

                </form>
            </div>
        </div>
    </div>
</div>

@include('footer')

@endsection
