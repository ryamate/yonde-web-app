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
                                    class="btn btn-block btn-pink rounded-pill text-white text-shadow shadow my-2"
                                    role="button">
                                    いますぐはじめる！
                                </a>
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
                <h2 class="d-flex justify-content-center flex-wrap">
                    <span>絵本の読み聞かせを</span>
                    <span>かんたんに</span>
                    <span>記録・管理できる</span>
                    <span>サービス</span>
                </h2>
                <h1 class="pb-4">『よんで』</h1>
                <p class="d-flex justify-content-center flex-wrap mt-4">
                    <span>「よんで」</span>
                </p>
                <p class="d-flex justify-content-center flex-wrap mt-4">
                    <span>こどもが絵本を読んでほしいときの</span>
                    <span>お決まりの</span>
                    <span>ことば。</span><br><br>
                </p>
                <p class="d-flex justify-content-center flex-wrap mt-4">
                    <span> こどもは、たくさんの絵本を読んでもらう。</span>
                    <span>同じ絵本を何度も読むこともある。</span>
                </p>
                <p class="d-flex justify-content-center flex-wrap mt-4">
                    <span>でも、好きな絵本を読んだ記憶は</span>
                    <span>薄れていって、</span>
                    <span>いつか大きくなった日には、</span>
                    <span>あんまり覚えてない。</span>
                </p>
                <p class="d-flex justify-content-center flex-wrap mt-4">
                    <span>記録して、</span>
                    <span>家族と共有しておくと、</span>
                    <span>いつでも記録から、</span>
                    <span>あの日読んだ記憶を</span>
                    <span>思い出せる。</span>
                </p>
            </div>
            <!-- smart phone -->
            <div class="container mt-2 mb-4 text-left d-block d-md-none">
                <h4 class="d-flex justify-content-start flex-wrap mb-4">
                    <span>絵本の読み聞かせを</span>
                    <span>かんたんに</span>
                    <span>記録・管理できる</span>
                    <span>サービス</span>
                    <span>『よんで』</span>
                </h4>
                <p class="d-flex justify-content-start flex-wrap mt-4">
                    <span>「よんで」</span>
                </p>
                <p class="d-flex justify-content-start flex-wrap mt-4">
                    <span>こどもが絵本を読んでほしいときの</span>
                    <span>お決まりの</span>
                    <span>ことば。</span><br><br>
                </p>
                <p class="d-flex justify-content-start flex-wrap mt-4">
                    <span> こどもは、たくさんの絵本を読んでもらう。</span>
                    <span>同じ絵本を何度も読むこともある。</span>
                </p>
                <p class="d-flex justify-content-start flex-wrap mt-4">
                    <span>でも、好きな絵本を読んだ記憶は</span>
                    <span>薄れていって、</span>
                    <span>いつか大きくなった日には、</span>
                    <span>あんまり覚えてない。</span>
                </p>
                <p class="d-flex justify-content-start flex-wrap mt-4">
                    <span>記録して、</span>
                    <span>家族と共有しておくと、</span>
                    <span>いつでも記録から、</span>
                    <span>あの日読んだ記憶を</span>
                    <span>思い出せる。</span>
                </p>
            </div>
        </div>

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
                                　気になる絵本、これまで読んだ絵本をいれることができます。他の家族のWeb本棚を見ていると、新しい絵本が発見できるかもしれません。
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 p-4">
                        <img src="{{ asset('image/index_3-2.png') }}" width="100%" alt="" style="max-width: 250px">
                        <div class="card-body p-0 text-secondary">
                            <p class="card-title">
                                <b>読み聞かせの記録・管理</b>
                            </p>
                            <p class="card-text small">
                                　絵本の読み聞かせをした記録をつけることができます。いつ読んだか、どんな反応だったか、具体的な記録が簡単にできます。
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
                                　本棚・読み聞かせ記録を家族と共有することができます。絵本を読んだ記録を、家族の思い出、こどもの成長の記録として残せます。
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            @guest
            {{-- pc --}}
            <div class="text-center d-none d-md-block border-bottom py-4 mx-5">
                <p class="text-mocha">
                    サンプル本棚をみてみる<i class="fas fa-chevron-down ml-2"></i>
                </p>
                <a href="{{ route('login.guest') }}" class="btn btn-outline-mocha rounded-pill px-5 my-2" role="button"
                    title="ゲストユーザーとしてログインする">
                    <b>ゲストユーザーログイン</b>
                </a>
            </div>
            {{-- smart phone --}}
            <div class="container">
                <div class="text-center d-block d-md-none border-bottom py-4">
                    <p class="text-mocha">
                        サンプル本棚をみてみる<i class="fas fa-chevron-down ml-2"></i>
                    </p>
                    <a href="{{ route('login.guest') }}" class="btn btn-block btn-outline-mocha rounded-pill my-2"
                        role="button" title="ゲストユーザーとしてログインする">
                        <b>ゲストユーザーログイン</b>
                    </a>
                </div>
            </div>
            @endguest

            <!-- pc -->
            <div style="margin-top: 74px;">
                <div class="bg-paper pt-5 pb-4 rounded">
                    <div class="container mb-4 text-center d-none d-md-block">
                        <h3 class="text-shadow mb-4">
                            <b>サービス名に込めた想い</b>
                        </h3>
                        <p class="d-flex justify-content-center flex-wrap mt-4">
                            <span>こどもに「よんで」と言われるとき、</span>
                            <span>こころよく読んであげられないときがあった。</span>
                        </p>
                        <p class="d-flex justify-content-center flex-wrap mt-4">
                            <span>疲れているとき、気分が乗らないときでも、</span>
                            <span>いつでもこどもに心を込めて絵本を読んであげたくなる気持ちになれたら…。</span>
                        </p>
                        <p class="d-flex justify-content-center flex-wrap mt-4">
                            <span>そうだ、</span>
                            <span>読んだ記録を手軽に楽しく付けられる</span>
                            <span>サービスを</span>
                            <span>つくってみよう。</span>
                        </p>
                        <p class="d-flex justify-content-center flex-wrap mt-4">
                            <span>読んだ記録をつけていくことで、</span>
                            <span>読んだ記録が増えていくことを楽しく感じられたら、こどもの「よんで」が待ち遠しくなる。</span>
                        </p>
                        <p class="d-flex justify-content-center flex-wrap mt-4">
                            <span>こどもの成長の記録としても楽しいし、</span>
                            <span>こどもが成長したときに、</span>
                            <span>こどもに読んできた絵本の記録を、</span>
                            <span>見せてあげることができたら、</span>
                        </p>
                        <h2 class="d-flex justify-content-center flex-wrap text-teal1 mt-4">
                            <span>こどもの「よんで」に</span>
                            <span>いつでもこたえてあげる気持ちになる。</span>
                        </h2>
                    </div>
                    <!-- smart phone -->
                    <div class="container mb-4 d-block d-md-none">
                        <h5 class="text-center mb-4">
                            <b>サービス名に込めた想い</b>
                        </h5>
                        <p class="d-flex justify-content-start flex-wrap mt-4">
                            <span>こどもに「よんで」と言われるとき、</span>
                            <span>こころよく読んであげられないときがあった。</span>
                        </p>
                        <p class="d-flex justify-content-start flex-wrap mt-4">
                            <span>疲れているとき、気分が乗らないときでも、</span>
                            <span>いつでもこどもに心を込めて絵本を読んであげたくなる気持ちになれたら…。</span>
                        </p>
                        <p class="d-flex justify-content-start flex-wrap mt-4">
                            <span>そうだ、</span>
                            <span>読んだ記録を手軽に楽しく付けられる</span>
                            <span>サービスを</span>
                            <span>つくってみよう。</span>
                        </p>
                        <p class="d-flex justify-content-start flex-wrap mt-4">
                            <span>読んだ記録をつけていくことで、</span>
                            <span>読んだ記録が増えていくことを楽しく感じられたら、こどもの「よんで」が待ち遠しくなる。</span>
                        </p>
                        <p class="d-flex justify-content-start flex-wrap mt-4">
                            <span>こどもの成長の記録としても楽しいし、</span>
                            <span>こどもが成長したときに、</span>
                            <span>こどもに読んできた絵本の記録を、</span>
                            <span>見せてあげることができたら、</span>
                        </p>
                        <h4 class="d-flex justify-content-start flex-wrap text-teal1 mt-4">
                            <span>こどもの「よんで」に</span>
                            <span>いつでもこたえてあげる</span>
                            <span>気持ちになる。</span>
                        </h4>
                    </div>
                    @guest
                    <div class="text-center d-none d-md-block">
                        <a class="btn btn-teal1 rounded-pill text-white text-shadow btn-lg shadow my-2 px-5"
                            href="{{ route('register') }}" role="button">新規登録する</a>
                    </div>
                    <div class="container d-block d-md-none">
                        <a class="btn btn-teal1 rounded-pill text-white text-shadow btn-block shadow my-2"
                            href="{{ route('register') }}" role="button">新規登録する</a>
                    </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</main>

@include('footer')

@endsection
