@extends('app')

@section('title', $user->yonde_id . '-よんで-')

@section('content')

@include('nav')

<div class="container">
    <div class="card mt-3">
        <div class="card-body">
            <div class="d-flex flex-row">
                <a href="{{ route('users.show', ['yonde_id' => $user->yonde_id]) }}" class="text-dark">
                    @if ($user->user_icon)
                    <img src="{{ asset('storage/user_images/' . $user->user_icon) }}" alt="プロフィール画像"
                        class="bg-white border" style="width: 100px; height:100px;background-position: center
                center;border-radius: 50%;object-fit:cover;" />
                    @else
                    <i class="fas fa-user-circle fa-3x"></i>
                    @endif
                </a>
                @if( Auth::id() !== $user->id )
                <follow-button class="ml-auto" :initial-is-followed-by='@json($user->isFollowedBy(Auth::user()))'
                    :authorized='@json(Auth::check())'
                    endpoint="{{ route('users.follow', ['yonde_id' => $user->yonde_id]) }}">
                </follow-button>
                @endif
            </div>
            <h2 class="h5 card-title m-0">
                <a href="{{ route('users.show', ['yonde_id' => $user->yonde_id]) }}" class="text-dark">
                    {{ $user->name }}
                </a>
            </h2>
        </div>
        <div class="card-body">
            <div class="card-text">
                <a href="" class="text-muted">
                    {{ $user->count_followings }} フォロー
                </a>
                <a href="" class="text-muted">
                    {{ $user->count_followers }} フォロワー
                </a>
            </div>
        </div>
    </div>
</div>

@include('footer')

@endsection
