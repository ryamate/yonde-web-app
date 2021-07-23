@extends('app')

@section('title', '家族設定-よんで-')

@section('content')

@include('nav')

<header>
    <div class="bg-paper">
        <div class="container" style="max-width: 900px;">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-paper small pl-0 mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" class="text-teal1">
                            よんで
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $family->nickname }}ファミリーの家族設定
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</header>

<div class="bg-paper py-4">
    <div class="container" style="max-width: 540px">
        <h4>家族設定</h4>
        <div class="row">
            <div class="col-sm-8">
                <h5>家族を招待しよう</h5>
                <p class="pt-2 mb-0">
                    子どもの絵本を読んだ記録を簡単に共有できます
                </p>
            </div>
            <div class="col-sm-4 my-2">
                <a class="btn btn-block bg-paper btn-outline-teal1 text-teal1" href="{{ route('invite') }}">
                    <i class="fas fa-plus mr-1"></i><b>招待する</b>
                </a>
            </div>
        </div>
        <img src="{{ asset('image/setting_family.png') }}" class="img-fluid mx-auto d-block" alt="" width="80%">
        @include('families.setting_tabs', [
        'hasUser' => false,
        'hasFamily' => true,
        ])
        <div class="card mt-2 p-4 shadow-sm">
            <div class="card-body py-2">
                <p class="card-title text-secondary small mb-1">ファミリーID</p>
                <p class="card-text">{{ $family->name }}</p>
            </div>
            <div class="card-body py-2">
                <p class="card-title text-secondary small mb-1">ファミリーネーム</p>
                <p class="card-text">{{ $family->nickname }}</p>
            </div>
            <div class="card-body pt-2">
                <p class="card-title text-secondary small mb-1">家族紹介</p>
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
                            <img src="{{ asset($user->icon_path) }}" alt="プロフィール画像" class="bg-white border"
                                style="width: 50px; height: 50px; background-position: center center; border-radius: 50%; object-fit:cover;">
                            @else
                            <p><i class="far fa-user-circle fa-3x text-secondary"></i></p>
                            @endif
                        </a>
                    </div>
                    <div class="col-9">
                        <a href="{{ route("users.index", ["name" => Auth::user()->name]) }}"
                            class="card-text text-teal1 text-decoration-none">
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
                            <img src="{{ asset($familyUser->icon_path) }}" alt="プロフィール画像" class="bg-white border"
                                style="width: 50px; height: 50px; background-position: center center; border-radius: 50%;object-fit:cover;">
                            @else
                            <p class="mb-0">
                                <i class="far fa-user-circle fa-3x text-secondary"></i>
                            </p>
                            @endif
                        </a>
                    </div>
                    <div class="col-9 mt-3">
                        <a href="{{ route("users.index", ["name" => $familyUser->name]) }}"
                            class="card-text text-teal1 text-decoration-none">
                            {{ $familyUser->nickname }}
                        </a>
                        <p class="card-text small text-secondary">
                            {{ $familyUser->relation }}
                        </p>
                    </div>
                </div>
                @endforeach

                <a class="btn btn-block btn-outline-paper text-decoration-none text-teal1 px-0 mt-4"
                    href="{{ route('invite') }}">
                    <i class="fas fa-plus mr-1"></i>家族を招待する
                </a>
            </div>

            <div class="card-body border-top">
                <p class="card-title text-secondary">お子さま一覧</p>
                @foreach ($children as $child)
                <div class="row">
                    <div class="col-3 d-flex justify-content-end mt-3">
                        <a href="{{ route('children.show', ['id' => $child->id]) }}">
                            @if(Carbon\Carbon::parse($child->birthday)->lte(Carbon\Carbon::now()->subYear())
                            && $child->gender_code === 2)
                            <img src="{{ asset('image/girl.png') }}" alt="プロフィール画像" class="bg-paper border"
                                style="width: 50px; height:50px;background-position: center;border-radius: 50%;object-fit:cover; margin-right:1px" />
                            @elseif(Carbon\Carbon::parse($child->birthday)->lte(Carbon\Carbon::now()->subYear()))
                            <img src="{{ asset('image/boy.png') }}" alt="プロフィール画像" class="bg-paper border"
                                style="width: 50px; height:50px;background-position: center;border-radius: 50%;object-fit:cover; margin-right:1px" />
                            @else
                            <img src="{{ asset('image/baby.png') }}" alt="プロフィール画像" class="bg-paper border"
                                style="width: 50px; height:50px;background-position: center;border-radius: 50%;object-fit:cover; margin-right:1px" />
                            @endif
                        </a>
                    </div>
                    <div class="col-9 mt-3">
                        <a href="{{ route('children.edit', ['id' => $child->id]) }}"
                            class="card-text text-teal1 text-decoration-none">
                            {{ $child->name }}
                        </a>
                        <p class="card-text d-flex flex-wrap align-items-center small text-secondary">
                            @if ($child->gender_code === 1)
                            <span class="badge badge-dark-mocha">
                                男の子
                            </span>
                            @elseif($child->gender_code === 2)
                            <span class="badge badge-mocha">
                                女の子
                            </span>
                            @endif

                            @if ($child->birthday !== null)
                            <span class="mx-1">/</span>
                            <span>
                                {{ Carbon\Carbon::parse($child->birthday)->diff(Carbon\Carbon::now())->format('%y歳%mヶ月') }}
                            </span>
                            <span class="mx-1">/</span>
                            <span>
                                {{ Carbon\Carbon::parse($child->birthday)->format("Y年m月d日") }}生まれ
                            </span>
                            @endif
                        </p>

                    </div>
                </div>
                @endforeach
                <a class="btn btn-block btn-outline-paper text-decoration-none text-teal1 px-0 mt-4"
                    href="{{ route('children.create') }}">
                    <i class="fas fa-plus mr-1"></i>お子さまを追加する
                </a>
            </div>

        </div>
    </div>
</div>

@include('footer')

@endsection
