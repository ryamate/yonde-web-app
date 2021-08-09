@extends('app')

@section('title', '家族設定編集-よんで-')

@section('content')

@include('nav')

<div class="bg-paper py-4">
    <div class="container" style="max-width: 540px">
        <h3 class="text-center">
            家族設定の編集
        </h3>

        @if (Auth::id() === config('const.GUEST_USER_ID'))
        <p class="text-danger">
            ※ゲストユーザーは、家族設定を編集できません。
        </p>
        @endif

        <div class="card shadow-sm mb-4">
            <div class="card-body">

                @include('error_card_list')

                <form action="{{ route('families.update') }}" method="post">
                    <input type="hidden" name="id" value="{{ $family->id }}" />
                    @csrf

                    <div class="form-group">
                        <label for="name">ファミリーID</label>
                        <input autofocus class="form-control" type="text" id="name"
                            value="{{ old('name',$family->name) }}" name="name" required
                            {{ Auth::id() === config('const.GUEST_USER_ID') ? 'readonly' : '' }} />
                        <p class="text-muted small ml-1">半角英数小文字：3～16文字</p>
                    </div>

                    <div class="form-group">
                        <label for="nickname">ファミリーネーム</label>
                        <input autofocus class="form-control" type="text" id="nickname"
                            value="{{ old('nickname',$family->nickname) }}" name="nickname" required
                            {{ Auth::id() === config('const.GUEST_USER_ID') ? 'readonly' : '' }} />
                        <p class="text-muted small ml-1">50文字以内</p>
                    </div>

                    <div class="form-group">
                        <label for="introduction">家族紹介</label>
                        <textarea type="text" name="introduction" id="introduction" rows="5" class="form-control"
                            {{ Auth::id() === config('const.GUEST_USER_ID') ? 'readonly' : '' }}>{{ $family->introduction ?? old('introduction') }}</textarea>
                        <p class="text-muted small ml-1">160文字以内</p>
                    </div>

                    @if (Auth::id() !== config('const.GUEST_USER_ID'))
                    <button type="submit" class="btn btn-block btn-teal1 mt-4">
                        <b>変更する</b>
                    </button>
                    @endif
                    <button type="button" onClick="history.back()"
                        class="btn btn-block bg-white btn-outline-teal1 text-decoration-none text-teal1 mt-3">
                        <i class="fas fa-arrow-left mr-1"></i>戻る
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('footer')

@endsection
