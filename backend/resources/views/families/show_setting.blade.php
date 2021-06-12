@extends('app')

@section('title', '家族設定-よんで-')

@section('content')

@include('nav')

<div class="bg-light pb-4">
    <div class="container" style="padding-top: 75px; max-width: 540px;">
        <h2>家族設定</h2>
        <div class="row">
            <div class="col-sm-8">
                <h4>家族を招待しよう</h4>
                <p class="pt-2 mb-0">
                    子どもの絵本を読んだ記録を簡単に共有できます
                </p>
            </div>
            <div class="col-sm-4 my-2">
                <a class="btn btn-block bg-white btn-outline-teal1 text-teal1" href="{{ route('invite') }}">
                    <b>＋招待する</b>
                </a>
            </div>


        </div>
        <img src="{{ asset('image/setting_family.png') }}" class="img-fluid mx-auto d-block" alt="" width="80%">
        <div class="card mt-2 p-4 shadow-sm">
            <div class="card-body">
                <p class="card-title text-secondary">ファミリーネーム</p>
                <h5 class="card-text">{{ $family->name }}</h5>
            </div>
            <div class="card-body">
                <p class="card-title text-secondary">家族の本棚紹介</p>
                <p class="card-text">{!! nl2br(e($family->introduction, false)) !!}</p>
            </div>
            <a class="btn btn-block bg-white btn-outline-teal1 text-decoration-none text-teal1 mb-4"
                href="{{ route('families.edit') }}">
                家族設定を編集
            </a>

            <div class="card-body border-top">
                <p class="card-title text-secondary">家族一覧</p>
                {{-- ユーザー本人 --}}
                <div class="row">
                    <div class="col-3 d-flex justify-content-end">
                        <a href="" class="">
                            @if ($user->icon_path)
                            <img src="{{ asset($user->icon_path) }}" alt="プロフィール画像"
                                style="width: 60px; background-position: center center;object-fit:cover;">
                            @else
                            <p><i class="far fa-user-circle fa-2x text-secondary"></i></p>
                            @endif
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route("users.show", ["name" => Auth::user()->name]) }}" class="">
                            <h5 class="card-text text-teal1"><b>{{ $user->nickname }}</b></h5>
                        </a>
                        <p class="card-text small text-secondary">{{ $user->relation }}</p>
                    </div>
                    <div class="d-none d-sm-block col-3 mt-2">
                        <a class="btn btn-block bg-white btn-outline-teal1 text-teal1"
                            href="{{ route('users.show_setting', ['name' => Auth::user()->name]) }}">
                            <b>設定</b>
                        </a>
                    </div>
                    <div class="col-12 d-block d-sm-none pt-2 mb-4">
                        <a class="btn btn-block bg-white btn-outline-teal1 text-teal1"
                            href="{{ route('users.show_setting', ['name' => Auth::user()->name]) }}">
                            <b>プロフィール設定</b>
                        </a>
                    </div>
                </div>

                {{-- ユーザーの家族 --}}
                @foreach ($familyUsers as $familyUser)
                <div class="row">
                    <div class="col-3 d-flex justify-content-end mt-3">
                        <a href="{{ route("users.show", ["name" => $familyUser->name]) }}">
                            @if ($familyUser->icon_path)
                            <img src="{{ asset($familyUser->icon_path) }}" alt="プロフィール画像"
                                style="width: 60px; background-position: center center;object-fit:cover;">
                            @else
                            <p class="mb-0">
                                <i class="far fa-user-circle fa-3x text-secondary"></i>
                            </p>
                            @endif
                        </a>
                    </div>
                    <div class="col-6 mt-3">
                        <a href="{{ route("users.show", ["name" => $familyUser->name]) }}">
                            <h5 class="card-text text-teal1">{{ $familyUser->nickname }}</h5>
                        </a>
                        <p class="card-text small text-secondary">{{ $familyUser->relation }}</p>
                    </div>
                </div>
                @endforeach

                <a class="btn btn-block bg-white text-decoration-none text-teal1 text-left mt-4"
                    href="{{ route('invite') }}">
                    ＋ 家族を招待する
                </a>
            </div>

            <div class="card-body border-top">
                <p class="card-title text-secondary">お子さま一覧</p>
                <a href="" class="text-teal1">
                    <h5 class="card-text">コドモ</h5>
                </a>
                <p class="card-text small text-secondary">男の子 / 2021年6月7日</p>
                @if( Auth::id() === $user->id )
                <a class="btn btn-block bg-white text-decoration-none text-teal1 text-left"
                    href="{{ route('users.edit') }}">
                    ＋ お子さまを追加する
                </a>
                @endif
            </div>

        </div>
    </div>
</div>

@include('footer')

@endsection
