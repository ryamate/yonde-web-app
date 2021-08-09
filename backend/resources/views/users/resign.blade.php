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
            　よんで を退会し、アカウント情報を削除します。
        </p>

        @if (Auth::id() === config('const.GUEST_USER_ID'))
        <p class="text-danger">※ゲストユーザーは、退会処理できません。</p>
        @endif

        <div class="card shadow-sm mb-4">
            <div class="card-body">

                <form action="{{ route('users.delete_data') }}" method="post">
                    <input type="hidden" name="id" value="{{ $user->id }}" />
                    <input type="hidden" name="name" value="{{ $user->name }}" />
                    <input type="hidden" name="nickname" value="{{ $user->nickname }}" />
                    <input type="hidden" name="email" value="{{ $user->email }}" />
                    @csrf

                    <div class="py-2">
                        <p class="card-title text-secondary mb-1">
                            退会する よんでID
                        </p>
                        <p class="card-text">
                            {{ $user->name }}
                        </p>
                    </div>
                    <div class="py-2">
                        <p class="card-title text-secondary mb-1">
                            ニックネーム
                        </p>
                        <p class="card-text">
                            {{ $user->nickname }}
                        </p>
                    </div>

                    @if (Auth::id() !== config('const.GUEST_USER_ID'))
                    <div class="mt-4">
                        <a class="btn btn-block btn-outline-pink text-danger" data-toggle="modal"
                            data-target="#modal-delete-{{ $user->id }}">
                            よんでを退会する
                        </a>
                    </div>
                    <p class="text-muted small ml-1">※退会しても、登録絵本、よんだよ記録は消えません。</p>
                    <!-- dropdown -->

                    <!-- modal -->
                    <div id="modal-delete-{{ $user->id }}" class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('users.delete_data') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $user->id }}" />
                                    <input type="hidden" name="name" value="{{ $user->name }}" />
                                    <input type="hidden" name="nickname" value="{{ $user->nickname }}" />
                                    <input type="hidden" name="email" value="{{ $user->email }}" />

                                    <div class="modal-body d-flex flex-wrap">
                                        <span>アカウント情報を削除します。</span>
                                        <span>本当によろしいですか？</span>

                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                                        <button type="submit" class="btn btn-danger">削除する</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- modal -->

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
