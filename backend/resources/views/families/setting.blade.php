@extends('app')

@section('title', '家族設定-よんで-')

@section('content')

@include('nav')

<header>
    <div class="bg-light">
        <div class="container" style="max-width: 900px;">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-light small pl-0 mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" class="text-teal1">
                            よんで
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $family->name }}ファミリーの家族設定
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</header>

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
        @include('families.setting_tabs', [
        'hasUser' => false,
        'hasFamily' => true,
        ])
        <div class="card mt-2 p-4 shadow-sm">
            <div class="card-body pt-0">
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
                            <p><i class="far fa-user-circle fa-3x text-secondary"></i></p>
                            @endif
                        </a>
                    </div>
                    <div class="col-9">
                        <a href="{{ route("users.index", ["name" => Auth::user()->name]) }}"
                            class="card-text text-teal1 text-decoration-none h5">
                            <b>{{ $user->nickname }}</b>
                        </a>
                        <p class="card-text small text-secondary">
                            {{ $user->relation }}
                        </p>
                    </div>
                </div>

                {{-- ユーザーの家族 --}}
                @foreach ($familyUsers as $familyUser)
                <div class="row">
                    <div class="col-3 d-flex justify-content-end mt-3">
                        <a href="{{ route("users.index", ["name" => $familyUser->name]) }}">
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
                    <div class="col-9 mt-3">
                        <a href="{{ route("users.index", ["name" => $familyUser->name]) }}"
                            class="card-text text-teal1 text-decoration-none h5">
                            {{ $familyUser->nickname }}
                        </a>
                        <p class="card-text small text-secondary">
                            {{ $familyUser->relation }}
                        </p>
                    </div>
                </div>
                @endforeach

                <a class="btn bg-white text-decoration-none text-teal1 mt-4" href="{{ route('invite') }}">
                    <i class="fas fa-plus mr-1"></i>家族を招待する
                </a>
            </div>

            <div class="card-body border-top">
                <p class="card-title text-secondary">お子さま一覧</p>
                @foreach ($children as $child)
                <div class="row">
                    <div class="col-12 mt-3">
                        <a href="{{ route('children.edit', ['id' => $child->id]) }}"
                            class="card-text text-teal1 text-decoration-none h5">
                            {{ $child->name }}
                        </a>

                        <p class="card-text small text-secondary">
                            @if ($child->gender_code === 1)
                            男の子
                            @elseif($child->gender_code === 2)
                            女の子
                            @endif
                            @if ($child->birthday !== null)
                            /
                            {{ Carbon\Carbon::parse($child->birthday)->diff(Carbon\Carbon::now())->format('%y歳%mヶ月') }}
                            / {{ Carbon\Carbon::parse($child->birthday)->format("Y年m月d日") }}
                            @endif
                        </p>

                    </div>
                </div>
                @endforeach
                <a class="btn bg-white text-decoration-none text-teal1 px-0 mt-4" href="{{ route('children.create') }}">
                    <i class="fas fa-plus mr-1"></i>お子さまを追加する
                </a>
            </div>

        </div>
    </div>
</div>

@include('footer')

@endsection
