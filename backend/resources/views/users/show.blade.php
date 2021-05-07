@extends('app')

@section('title', 'プロフィール詳細-よんで-')

@section('content')

@include('nav')

<div class="container" style="margin-top: 75px; max-width: 540px;">
    <h2>プロフィール設定</h2>
    <table class="container table table-bordered">
        <tr>
            <th>よんでID</th>
            <td>{{ $user->yonde_id }}</td>
        </tr>

        <tr>
            <th>ニックネーム</th>
            <td>{{ $user->name }}</td>
        </tr>

        <tr>
            <th>プロフィール画像</th>
            <td>
                @if ($user->user_icon)
                <img src="{{ asset('storage/user_images/' . $user->user_icon) }}" ?>" alt="プロフィール画像"
                style="width: 100px; height:100px;background-position: center center;object-fit:cover;">
                @else
                <i class="far fa-user-circle fa-5x text-secondary"></i>
                @endif
            </td>
        </tr>

        <tr>
            <th>自己紹介</th>
            <td>{{ $user->introduction }}</td>
        </tr>
    </table>
    <!-- 絵本の読み聞かせ記録ボタン -->
    @if( Auth::id() === $user->id )
    <a class="btn btn-block btn-outline-dark common-btn edit-profile-btn" href="/users/edit">プロフィールを編集</a>
    @endif
</div>

@include('footer')

@endsection
