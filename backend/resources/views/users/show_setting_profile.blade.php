@extends('app')

@section('title', 'プロフィール詳細-よんで-')

@section('content')

@include('nav')

<div class="container" style="margin-top: 75px; max-width: 540px;">
    <h2>プロフィール設定</h2>
    <table class="container table table-bordered">
        <dl>
            <dt>よんでID</dt>
            <dd>{{ $user->yonde_id }}</dd>
        </dl>

        <dl>
            <dt>ニックネーム</dt>
            <dd>{{ $user->name }}</dd>
        </dl>

        <dl>
            <dt>プロフィール画像</dt>
            <dd>
                @if ($user->icon_path)
                <img src="{{ asset($user->icon_path) }}" alt="プロフィール画像"
                    style="width: 100px; height:100px;background-position: center center;object-fit:cover;">
                @else
                <i class="far fa-user-circle fa-5x text-secondary"></i>
                @endif
            </dd>
        </dl>

        <dl>
            <dt>自己紹介</dt>
            <dd>{!! nl2br(e($user->introduction)) !!}</dd>
        </dl>
    </table>
    <!-- 絵本の読み聞かせ記録ボタン -->
    @if( Auth::id() === $user->id )
    <a class="btn btn-block bg-white btn-outline-teal1 text-decoration-none text-teal1"
        href="{{ route('users.edit') }}">プロフィールを編集</a>
    @endif
</div>

@include('footer')

@endsection
