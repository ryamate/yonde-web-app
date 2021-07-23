<nav class="navbar navbar-expand-md navbar-light shadow-sm bd-navbar py-1"
    style="vertical-align: middle; position: sticky; top: 0; z-index: 1071; background: linear-gradient(-135deg, #26a69a, #f2f7f7) fixed;">

    {{-- left: application logo --}}
    <a class="navbar-brand mr-2 p-0" href="{{ route('home') }}">
        <img src="{{ asset('image/logo.png') }}" height="30" class="d-inline-block align-top text-decoration-none"
            alt="yonde">
    </a>

    {{-- left: application name --}}
    <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link text-white text-shadow text-decoration-none mb-0 h4" href="{{ route('home') }}">よんで</a>
        </li>
    </ul>

    {{-- toggle button --}}
    <button class="navbar-toggler p-1" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        {{-- right: --}}
        <ul class="navbar-nav ml-auto">
            @include('navs.pc_right')
            @include('navs.phone_toggle')
        </ul>
    </div>
</nav>

@auth
@if (Auth::user()->email_verified_at === null)
<nav class="navbar navbar-expand-md navbar-light shadow-sm bd-navbar py-1"
    style="background: linear-gradient(-135deg, #F1C565, #F2BF6C) fixed;">
    <small>
        <i class="fas fa-exclamation-triangle"></i>ご利用中のよんでIDは、メールアドレス認証がされていません。 <a
            href="{{ route('users.setting_profile') }}">メールアドレス認証はこちら</a>
    </small>
</nav>
@endif
@endauth
