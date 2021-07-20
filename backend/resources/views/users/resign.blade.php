@extends('app')

@section('title', '退会-よんで-')

@section('content')

@include('nav')

<div class="bg-paper py-4">
    <div class="container" style="max-width: 540px">
        <h3 class="text-center">
            よんで を退会する
        </h3>
        <p style="font-size: 14px;">
            　よんで を退会し、よんでID を削除します。
        </p>

        @if (Auth::id() === config('const.GUEST_USER_ID'))
        <p class="text-danger">※ゲストユーザーは、退会処理できません。</p>
        @endif

        <div class="card shadow-sm mb-4">
            <div class="card-body">

                @include('error_card_list')

                <form action="{{ route('users.delete_data') }}" method="post">
                    <input type="hidden" name="id" value="{{ $user->id }}" />
                    <input type="hidden" name="name" value="{{ $user->name }}" />
                    <input type="hidden" name="nickname" value="{{ $user->nickname }}" />
                    <input type="hidden" name="email" value="{{ $user->email }}" />
                    @csrf

                    <div class="form-group">
                        <div class="py-2">
                            <p class="card-title text-secondary mb-1">
                                退会する よんでID
                            </p>
                            <p class="card-text">
                                {{ Auth::user()->name }}
                            </p>
                        </div>
                        <div class="py-2">
                            <p class="card-title text-secondary mb-1">
                                ニックネーム
                            </p>
                            <p class="card-text">
                                {{ Auth::user()->nickname }}
                            </p>
                        </div>
                    </div>

                    @if (Auth::id() !== config('const.GUEST_USER_ID'))
                    <button type="submit" class="btn btn-block  btn-outline-pink mt-4">
                        <b>よんでを退会する</b>
                    </button>
                    @endif
                    <button type="button" onClick="history.back()" class="btn btn-block btn-teal1 mt-3">
                        <i class="fas fa-arrow-left mr-1"></i>戻る
                    </button>

                </form>
            </div>
        </div>
    </div>
</div>

@include('footer')

@endsection
