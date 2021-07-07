@extends('app')

@section('title', $family->name . 'ファミリーのページ-よんで-')

@section('content')

@include('nav')

<header>
    <div class="bg-light">
        <div class="container" style="max-width: 900px;">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-light small pl-0 mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" class="text-teal1">
                            よんで
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $family->name }}ファミリーのタイムライン
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</header>

<div class="bg-light pb-4">
    <div class="container">
        <div class="row">
            <div class="container" style="max-width: 900px;">
                <div class="card">
                    @include('families.family_card')
                    @include('families.tabs', [
                    'hasBookshelf' => false,
                    'hasPictureBooks' => true,
                    ])
                </div>
                @include('families.index_tabs', [
                'hasStored' => true,
                'hasReadRecord' => false,
                ])

                @if (Auth::user()->family_id === $family->id)
                @include('families.bookshelf_search_bar')
                @endif

                @foreach($pictureBooks as $pictureBook)
                @if (!$loop->first)
                <div class="border-top"></div>
                @endif
                <section class="py-4">
                    <div class="py-1">
                        <a href="{{ route('users.show', ['name' => $pictureBook->user->name]) }}" class="text-dark">
                            @if ($pictureBook->user->icon_path)
                            <img src="{{ asset($pictureBook->user->icon_path) }}" class="border" alt="プロフィール画像" style="width:25px; height:25px;background-position: center
                                            center;border-radius: 50%;object-fit:cover;">
                            @else
                            <i class="far fa-user-circle fa-1x"></i>
                            @endif
                            <span class="text-teal1 small">
                                {{ ' ' . $pictureBook->user->nickname}}
                            </span>
                        </a>
                        @if ($pictureBook->created_at == $pictureBook->updated_at)
                        <span class="text-muted small">
                            さんが『
                            <a href="{{ route('families.show', [
                                                        'id' => Auth::user()->family_id,
                                                        'picture_book' => $pictureBook,
                                                        ]) }}" class="card-title text-teal1">
                                <b>{{ $pictureBook->title }}</b>
                            </a>
                            』を本棚に登録しました。
                        </span>
                        @else
                        <span class="text-muted small">
                            さんが本棚の『
                            <a href="{{ route('families.show', [
                                                        'id' => Auth::user()->family_id,
                                                        'picture_book' => $pictureBook,
                                                        ]) }}" class="card-title text-teal1">
                                <b>{{ $pictureBook->title }}</b>
                            </a>
                            』を更新しました。
                        </span>
                        @endif

                        <span class="text-muted small">
                            @if (Carbon\Carbon::parse($pictureBook->updated_at)->diffInDays(now()) == 0)
                            (今日)
                            @else
                            ({{ Carbon\Carbon::parse($pictureBook->updated_at)->diffInDays(now()) }}日前)
                            @endif
                        </span>
                    </div>
                    @include('families.picture_book_card')
                </section>
                @endforeach
                {{ $pictureBooks->links( 'vendor.pagination.bootstrap-4_teal' ) }}
            </div>
        </div>
    </div>
</div>

@include('footer')

@endsection
