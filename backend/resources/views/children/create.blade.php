@extends('app')

@section('title', 'お子さま追加-よんで-')

@section('content')

@include('nav')

<div class="bg-light">
    <div class="container">
        <div class="row">
            <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6 mt-4" style="margin-bottom: 90px">
                <h2 class="text-center"><a class="text-dark text-decoration-none">お子さま追加</a></h2>

                <div class="card mt-4 p-4 shadow-sm">

                    @include('error_card_list')

                    <form action="{{ route('children.store') }}" method="post">
                        @include('children.form')
                        <button type="submit"
                            class="btn btn-block bg-white btn-outline-teal1 text-decoration-none text-teal1 mt-4">
                            <b>追加完了する</b>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('footer')

</div>
@endsection
