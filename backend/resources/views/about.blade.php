@extends('app')

@section('title', 'よんでとは')

@section('content')

@include('nav')

<header>
    <div class="bg-paper">
        <div class="container" style="max-width: 900px;">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-paper small pl-0 mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" class="text-teal1">よんで</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        よんでとは
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="content">
        <div class="py-5">
            <div class="container" style="max-width: 900px">
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ asset('image/index_top.png') }}" class="img-fluid mx-auto d-block" alt=""
                            width="80%">
                    </div>
                    <div class="col-md-6">
                        <div class="d-none d-xl-block">
                            <h1 class="text-shadow">
                                <b>こどもの「よんで」が<br>
                                    楽しみになる</b>
                            </h1>
                        </div>
                        <div class="d-none d-md-block d-xl-none">
                            <h3 class="text-shadow pt-3">
                                <b>こどもの「よんで」が<br>
                                    楽しみになる</b>
                            </h3>
                        </div>

                        <div class="col-md-6 d-block d-md-none text-center text-shadow pt-3">
                            <h4>
                                <b>こどもの「よんで」が<br>
                                    楽しみになる</b>
                            </h4>
                        </div>
                        <div class="container p-2">
                            <p class="text-shadow">
                                Web上の本棚にいれた絵本の、読み聞かせ記録・管理をして、家族と共有できるサービスです。
                            </p>
                            @guest
                            <div class="text-center">
                                <a href="{{ route('register') }}"
                                    class="btn btn-block btn-warning mt-2 mb-2 rounded-pill text-white shadow"
                                    role="button">いますぐはじめる！</a>
                            </div>
                            @endguest
                            @auth
                            <div class="text-center">
                                <a href="{{ route('families.bookshelf', ["name" => Auth::user()->family->name]) }}"
                                    class="btn btn-block btn-teal1 mt-2 mb-2 rounded-pill text-white shadow"
                                    role="button">本棚ページをみる</a>
                            </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<main>
    <div class="container" style="max-width: 900px">
        <!-- pc -->
        <div style="margin-top: 74px;">
            <div class="container mt-4 mb-4 text-center d-none d-md-block">
                <h2>
                    <b>絵本読み聞かせの記録を<br>
                        かんたんに管理できるサービス<br>
                        『よんで』</b>
                </h2>
                <p class="text-dark pt-4">
                    「よんで」<br>
                    こどもが絵本をおねだりするときのおきまりの言葉。<br><br>

                    こどもは、たくさんの絵本を読んでもらう。<br>
                    同じ絵本を何度も読むことも。<br><br>

                    でも、その絵本を読んだ記憶は埋もれてしまって、<br>
                    いつか大きくなった日、ほとんどは忘れてしまう。<br><br>

                    だから、記録して、家族と共有しておくと、<br>
                    いつでも記録から、あの日読んだ記憶を思い出せる。
                </p>
            </div>
            <!-- smart phone -->
            <div class="container mt-2 mb-4 text-left d-block d-md-none">
                <h5>
                    <b>絵本読み聞かせの記録を<br>
                        かんたんに管理できるアプリ『よんで』</b>
                </h5>
                <p class="small mt-4">
                    「よんで」<br><br>

                    こどもが絵本をおねだりするときのおきまりの言葉。<br><br>

                    こどもは、たくさんの絵本を読んでもらう。同じ絵本を何度も読むことも。<br><br>

                    でも、その絵本を読んだ記憶は埋もれてしまって、<br>
                    いつか大きくなった日、ほとんどは忘れてしまう。<br><br>

                    だから、記録して、家族と共有しておくと、<br>
                    いつでも記録から、あの日読んだ記憶を思い出せる。
                </p>
            </div>
        </div>

        {{-- pc --}}
        <div style="margin-top: 74px;">
            <div class="card-deck row no-gutters">
                <div class="col-md-4">
                    <div class="card border-0 p-4">
                        <img src="{{ asset('image/index_3-1.png') }}" width="100%" alt="" style="max-width: 250px">
                        <div class="card-body p-0 text-secondary">
                            <p class="card-title">
                                <b>絵本のWeb本棚</b>
                            </p>
                            <p class="card-text small">
                                気になる絵本、これまで読んだ絵本をいれることができます。<br>
                                Web本棚を見れば、どの絵本が読みたいか、こどもが教えてくれるかもしれません。
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 p-4">
                        <div class="d-flex justify-content-end">
                            <img src="{{ asset('image/index_3-2.png') }}" width="100%" alt="" style="max-width: 250px">
                        </div>
                        <div class="card-body p-0 text-secondary text-right text-md-left">
                            <p class="card-title">
                                <b>読み聞かせの記録・管理</b>
                            </p>
                            <p class="card-text small">
                                絵本の読み聞かせをした記録を付けることができます。<br>
                                いつ読んだか、何回目かなど、具体的な記録が簡単にできます。
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 p-4">
                        <img src="{{ asset('image/index_3-3-0.png') }}" width="100%" alt="" style="max-width: 250px">
                        <img src="{{ asset('image/index_3-3.png') }}" width="100%" alt="" style="max-width: 250px">
                        <img src="{{ asset('image/index_3-3-2.png') }}" width="100%" alt="" style="max-width: 250px">
                        <div class="card-body p-0 text-secondary">
                            <p class="card-title">
                                <b>家族と共有</b>
                            </p>
                            <p class="card-text small">
                                本棚・読み聞かせ記録を家族と共有することができます。<br>
                                絵本を読んだ記録が、家族のアルバムのように残ります。
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            @guest
            {{-- pc --}}
            <div class="text-center d-none d-md-block border-bottom pb-4 mx-5">
                <a href="{{ route('login.guest') }}" class="btn btn-outline-info mt-2 mb-2" role="button"
                    style="border-radius: 24px" title="ゲストユーザーとしてログイン">
                    　　　サンプル本棚をみてみる　　<i class="fas fa-chevron-right"></i>
                </a>
            </div>
            {{-- smart phone --}}
            <div class="container">
                <div class="text-center d-block d-md-none border-bottom py-4">
                    <a href="{{ route('login.guest') }}" class="btn btn-block btn-outline-info mt-2 mb-2 rounded-pill"
                        role="button" title="ゲストユーザーとしてログイン">
                        サンプル本棚をみてみる<i class="fas fa-chevron-right ml-1"></i>
                    </a>
                </div>
            </div>
            @endguest

            <!-- pc -->
            <div style="margin-top: 74px;">
                <div class="bg-paper pt-5 pb-4 rounded">
                    <div class="container mb-4 text-center d-none d-md-block">
                        <h3 class="mb-4">
                            <b>サービス名に込めた想い</b>
                        </h3>
                        <p>
                            こどもに「よんで」と言われるとき、こころよく読んであげられないときがある。<br>
                            いつでもこどもに心を込めて絵本を読んであげたくなる気持ちになれたら。<br>
                            疲れているとき、気分が乗らないときでも。<br><br>

                            読んだ記録をつけていくことで、<br>
                            読んだ記録が積み上がっていって、読んであげるのが楽しく感じられたら。<br><br>

                            こどもの成長の記録としても楽しいし、<br>
                            こどもが成長したときに、<br>
                            こどもに読んであげた絵本の記録を、<br>
                            いつでも見返すことができる。<br><br>

                            みんなが実際に何度も読んでいる絵本を知れることで、<br>
                            いい絵本とたくさん出会ってもらいたい。<br>
                            何度も「よんで」と言ってもらえる心に残る絵本を読んであげたい。<br><br>
                        </p>
                        <h2 class="text-teal1">
                            <b>こどもの「よんで」に<br>
                                いつでもこたえてあげる気持ちになる</b>
                        </h2>
                    </div>
                    <!-- smart phone -->
                    <div class="container mb-4 d-block d-md-none">
                        <h5 class="mb-4">
                            <b>サービス名に込めた想い</b>
                        </h5>
                        <p class="small">
                            こどもに「よんで」と言われるとき、こころよく読んであげられないときがある。<br>
                            いつでもこどもに心を込めて絵本を読んであげたくなる気持ちになれたら。<br>
                            疲れているとき、気分が乗らないときでも。<br><br>

                            読んだ記録をつけていくことで、<br>
                            読んだ記録が積み上がっていって、読んであげるのが楽しく感じられたら。<br><br>

                            こどもの成長の記録としても楽しいし、<br>
                            こどもが成長したときに、<br>
                            こどもに読んであげた絵本の記録を、<br>
                            いつでも見返すことができる。<br><br>

                            みんなが実際に何度も読んでいる絵本を知れることで、<br>
                            いい絵本とたくさん出会ってもらいたい。<br>
                            何度も「よんで」と言ってもらえる心に残る絵本を読んであげたい。<br><br>
                        </p>
                        <h4 class="text-teal1 text-shadow">
                            こどもの「よんで」に<br>
                            いつでもこたえてあげる気持ちになる
                        </h4>
                    </div>
                    @guest
                    <div class="text-center d-none d-md-block">
                        <a class="btn btn-teal1 btn-lg shadow mt-2 mb-2" href="{{ route('register') }}"
                            role="button">新規登録する</a>
                    </div>
                    <div class="container d-block d-md-none">
                        <a class="btn btn-teal1 btn-block shadow mt-2 mb-2" href="{{ route('register') }}"
                            role="button">新規登録する</a>
                    </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</main>

@include('footer')

@endsection
