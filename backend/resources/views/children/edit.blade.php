@extends('app')

@section('title', 'お子さま情報-よんで-')

@section('content')

@include('nav')

<div class="bg-light">
    <div class="container">
        <div class="row">
            <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6 mt-4" style="margin-bottom: 90px">
                <h2 class="text-center"><a class="text-dark text-decoration-none">お子さま情報</a></h2>

                <div class="card mt-4 p-4 shadow-sm">

                    @include('error_card_list')

                    <form action="{{ route('children.update', ['id' => $child->id]) }}" method="post">
                        @include('children.form')
                        <button type="submit"
                            class="btn btn-block bg-white btn-outline-teal1 text-decoration-none text-teal1 mt-4">
                            <b>編集完了する</b>
                        </button>
                    </form>
                </div>
                <div class="m-4">
                    <a class="btn btn-block bg-white btn-outline-danger text-decoration-none text-danger"
                        data-toggle="modal" data-target="#modal-delete-{{ $child->id }}">
                        お子さまの情報を削除
                    </a>
                </div>
                <!-- dropdown -->

                <!-- modal -->
                <div id="modal-delete-{{ $child->id }}" class="modal fade" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="POST" action="{{ route('children.destroy', ['id' => $child->id]) }}">
                                @csrf
                                @method('DELETE')
                                <div class="modal-body">
                                    お子さま（{{ $child->name }}）の情報を削除します。よろしいですか？
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

            </div>
        </div>
    </div>
</div>

@include('footer')

</div>
@endsection
