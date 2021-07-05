@extends('app')

@section('title', 'よんでとは')

@section('content')

@include('nav')

<header>
    <div class="bg-light">
        <div class="container" style="max-width: 900px;">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-light small pl-0 mb-0">
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
                <!-- pc -->
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ asset('image/index_top.png') }}" class="img-fluid mx-auto d-block" alt=""
                            width="80%">
                    </div>
                    <div class="col-md-6">
                        <div class="d-none d-xl-block">
                            <h1>
                                <b>こどもの「よんで」が<br>
                                    楽しみになる</b>
                            </h1>
                        </div>
                        <div class="d-none d-md-block d-xl-none">
                            <h3 class="pt-3">
                                <b>こどもの「よんで」が<br>
                                    楽しみになる</b>
                            </h3>
                        </div>
                        <div class="text-center col-md-6 d-block d-md-none pt-2">
                            <h4>
                                <b>こどもの「よんで」が<br>
                                    楽しみになる</b>
                            </h4>
                        </div>
                        <div class="container p-2">
                            <p>Web上の本棚にいれた絵本の、読み聞かせ記録・管理をして、家族と共有できるサービスです。</p>
                            <div class="text-center">
                                <a href="{{ route('register') }}"
                                    class="btn btn-block btn-warning mt-2 mb-2 rounded-pill text-white"
                                    role="button">いますぐはじめる！</a>
                            </div>
                        </div>
                    </div>
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
                        アルバムのように管理できるサービス<br>
                        『よんで』</b>
                </h2>
                <p class="text-dark pt-4">
                    「よんで」は、<br>
                    こどもが絵本読み聞かせをおねだりするときのお決まりのセリフ。<br><br>

                    こどもは、たくさんの絵本を読む。<br>
                    こどもが絵本好きだと、同じ絵本を何度も読むこともある。<br><br>

                    でも、その絵本を読んだ記録をつけることはあまりなく、<br>
                    いつか子供が大きくなると、自分が読み聞かせてもらった本の大半は忘れてしまう。<br><br>

                    だから、記録として残して家族と共有しておくと、<br>
                    いつか、記録から記憶を思い出せる「アルバム」になる。
                </p>
            </div>
            <!-- smart phone -->
            <div class="container mt-2 mb-4 text-left d-block d-md-none">
                <h5>
                    <b>絵本読み聞かせの記録を<br>
                        アルバムのように管理できるアプリ<br>
                        『よんで』</b>
                </h5>
                <p class="small">
                    「よんで」は、<br>
                    こどもが絵本読み聞かせをおねだりするときのお決まりのセリフ。<br><br>

                    こどもは、たくさんの絵本を読む。<br>
                    こどもが絵本好きだと、同じ絵本を何度も読むこともある。<br><br>

                    でも、その絵本を読んだ記録をつけることはあまりなく、<br>
                    いつか子供が大きくなると、自分が読み聞かせてもらった本の大半は忘れてしまう。<br><br>

                    だから、記録として残して家族と共有しておくと、<br>
                    いつか、記録から記憶を思い出せる「アルバム」になる。
                </p>
            </div>
        </div>

        {{-- pc --}}
        <div style="margin-top: 74px;">
            <div class="d-none d-md-block">
                <div class="card-deck row no-gutters">
                    <div class="col-md-4">
                        <div class="card border-0 p-4">
                            <img src="{{ asset('image/index_3-1.png') }}" width="100%" alt="">
                            <div class="card-body p-0 text-secondary">
                                <p class="card-title">
                                    <b>絵本の本棚</b>
                                </p>
                                <p class="card-text small">
                                    気になる絵本、これまで読んだ絵本をいれることができます。<br>
                                    Web画面を見てもらえばどの絵本がよみたいか、こどもが教えてくれるかもしれません。
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 p-4">
                            <img src="{{ asset('image/index_3-2.png') }}" width="100%" alt="">
                            <div class="card-body p-0 text-secondary">
                                <p class="card-title">
                                    <b>読み聞かせの記録・管理</b>
                                </p>
                                <p class="card-text small">
                                    絵本の読み聞かせをした記録を付けることができます。<br>
                                    いつ読んだか、どの子に読んだか、何回目かなど、読んだ内容がより具体的にわかるようになります。
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 p-4">
                            <img src="{{ asset('image/index_3-3-0.png') }}" width="100%" alt="">
                            <img src="{{ asset('image/index_3-3.png') }}" width="100%" alt="">
                            <img src="{{ asset('image/index_3-3-2.png') }}" width="100%" alt="">
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
            </div>
            {{-- smart phone --}}
            <div class="d-block d-md-none">
                <div class="card mb-2">
                    <div class="card-body shadow">
                        <div class="row no-gutters">
                            <div class="col-6 d-flex align-items-center pr-3">
                                <img src="{{ asset('image/index_3-1.png') }}" width="100%" alt="">
                            </div>
                            <div class="col-6 border-left">
                                <div class="card-body pr-0">
                                    <p class="card-title small">
                                        <b>絵本の本棚</b>
                                    </p>
                                    <p class="card-text small">気になる絵本、これまで読んだ絵本をいれることができます。<br>
                                        Web画面を見てもらえばどの絵本がよみたいか、こどもが教えてくれるかもしれません。</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-2">
                    <div class="card-body shadow">
                        <div class="row no-gutters">
                            <div class="col-6 pr-3">
                                <div class="card-body pl-0">
                                    <p class="card-title small">
                                        <b>読み聞かせの記録・管理</b>
                                    </p>
                                    <p class="card-text small">
                                        絵本の読み聞かせをした記録を付けることができます。<br>
                                        いつ読んだか、どの子に読んだか、何回目かなど、読んだ内容がより具体的にわかるようになります。
                                    </p>
                                </div>
                            </div>
                            <div class="col-6 d-flex align-items-center justify-content-center border-left pl-3">
                                <img src="{{ asset('image/index_3-2.png') }}" width="80%" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-2">
                    <div class="card-body shadow">
                        <div class="row no-gutters">
                            <div class="col-6 d-flex align-items-center pr-3">
                                <img src="{{ asset('image/index_3-3.png') }}" width="100%" alt="">
                            </div>
                            <div class="col-6 border-left">
                                <div class="card-body pr-0">
                                    <p class="card-title small">
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
                </div>
            </div>

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
                        　　サンプルの本棚をみてみる　<i class="fas fa-chevron-right"></i>
                    </a>
                </div>
            </div>

            <!-- pc -->
            <div style="margin-top: 74px;">
                <div class="bg-light pt-5 pb-4 rounded">
                    <div class="container mt-4 mb-4 text-center d-none d-md-block">
                        <h2>
                            <b>サービス名に込めた想い</b>
                        </h2>
                        <p>
                            疲れているとき、気分が乗らないときでも、<br>
                            積み上げていく感じで読んできた記録をつけていくことで、<br>
                            こどもに心を込めて絵本を読んであげたくなる気持ちになりたい。<br><br>

                            積み上げていく感じで読んだ記録をつけていくことで、<br>
                            同じ絵本を読んでいると飽きてしまう読む側と、<br>
                            何度でも読んでほしいこどもの、気持ちのギャップを埋めたい。<br><br>

                            こどもが成長したときに、<br>
                            こどもに読んであげた絵本の記録が、<br>
                            いつか見返すことができるアルバムのようなプレゼントになる。<br><br>

                            みんなが実際に何度も読んでいる本を知って、<br>
                            こどもにいい絵本とたくさん出会わせてあげたい。<br><br>
                            絵本を買うなら何度も「よんで」と言ってもらえる心に残る絵本を選びたい。
                        </p>
                        <h2 class="text-teal1">
                            <b>こどもの「よんで」に<br>
                                いつでもこたえてあげる気持ちになる</b>
                        </h2>
                    </div>
                    <!-- smart phone -->
                    <div class="container mt-4 mb-4 d-block d-md-none">
                        <h4>
                            <b>サービス名に込めた想い</b>
                        </h4>
                        <p class="small">
                            疲れているとき、気分が乗らないときでも、<br>
                            積み上げていく感じで読んできた記録をつけていくことで、<br>
                            こどもに心を込めて絵本を読んであげたくなる気持ちになりたい。<br><br>

                            積み上げていく感じで読んだ記録をつけていくことで、<br>
                            同じ絵本を読んでいると飽きてしまう読む側と、<br>
                            何度でも読んでほしいこどもの、気持ちのギャップを埋めたい。<br><br>

                            こどもが成長したときに、<br>
                            こどもに読んであげた絵本の記録が、<br>
                            いつか見返すことができるアルバムのようなプレゼントになる。<br><br>

                            みんなが実際に何度も読んでいる本を知って、<br>
                            こどもにいい絵本とたくさん出会わせてあげたい。<br><br>
                            絵本を買うなら何度も「よんで」と言ってもらえる心に残る絵本を選びたい。
                        </p>
                        <h4 class="text-teal1">
                            <b>こどもの「よんで」に<br>
                                いつでもこたえてあげる気持ちになる</b>
                        </h4>
                    </div>
                    <div class="text-center d-none d-md-block">
                        <a class="btn btn-teal1 btn-lg shadow mt-2 mb-2" href="{{ route('register') }}"
                            role="button">新規登録する</a>
                    </div>
                    <div class="container d-block d-md-none">
                        <a class="btn btn-teal1 btn-block shadow mt-2 mb-2" href="{{ route('register') }}"
                            role="button">新規登録する</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@include('footer')

@endsection
