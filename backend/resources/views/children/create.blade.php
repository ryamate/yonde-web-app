@extends('app')

@section('title', 'お子さま追加-よんで-')

@section('content')

@include('nav')

<div class="bg-paper py-4">
    <div class="container" style="max-width: 540px">
        <h3 class="text-center">
            お子さま追加
        </h3>

        <div class="card shadow-sm mb-4">
            <div class="card-body">

                @include('error_card_list')

                <form action="{{ route('children.store') }}" method="post">
                    @include('children.form')
                    <button type="submit" class="btn btn-block btn-teal1 mt-4">
                        <b>追加完了する</b>
                    </button>
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
