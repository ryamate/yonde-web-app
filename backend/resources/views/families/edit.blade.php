@extends('app')

@section('title', '家族設定編集-よんで-')

@section('content')

@include('nav')

<div class="bg-light py-4">
    <div class="container" style="max-width: 540px">
        <h3 class="text-center">
            家族編集
        </h3>

        @if (Auth::id() === config('const.GUEST_USER_ID'))
        <p class="text-danger">
            ※ゲストユーザーは、家族設定編集できません。
        </p>
        @endif

        <div class="card shadow-sm mb-4">
            <div class="card-body">

                @include('error_card_list')

                <form action="{{ route('families.update') }}" method="post">
                    <input type="hidden" name="id" value="{{ $family->id }}" />
                    @csrf

                    <div class="form-group">
                        <label for="name">ファミリーネーム</label>
                        <input autofocus class="form-control" type="text" id="name"
                            value="{{ old('name',$family->name) }}" name="name" required
                            {{ Auth::id() === config('const.GUEST_USER_ID') ? 'readonly' : '' }} />
                        <ul class="text-dark small">
                            <li>100文字以内</li>
                            <li>他のユーザー画面にも表示されます</li>
                        </ul>
                    </div>

                    <div class="form-group">
                        <label for="introduction">家族の本棚紹介文</label>
                        <textarea type="text" name="introduction" id="introduction" rows="5" class="form-control"
                            {{ Auth::id() === config('const.GUEST_USER_ID') ? 'readonly' : '' }}>{{ $family->introduction ?? old('introduction') }}</textarea>
                        <ul class="text-dark small">
                            <li>1000文字以内</li>
                        </ul>
                    </div>

                    @if (Auth::id() !== config('const.GUEST_USER_ID'))
                    <button type="submit"
                        class="btn btn-block bg-white btn-outline-teal1 text-decoration-none text-teal1 mt-4"><b>変更する</b></button>
                    @else
                    <a href="{{ route('families.setting') }}"
                        class="btn btn-block bg-white btn-outline-danger text-decoration-none text-danger mt-4">戻る</a>
                    @endif

                </form>
            </div>
        </div>
    </div>
</div>

@include('footer')

@endsection
