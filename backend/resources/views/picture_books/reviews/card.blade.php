<div class="card shadow-sm my-1">
    <div class="row">
        <div class="col-sm-3">
            <div class="card-body">
                <div class="d-flex justify-content-start align-items-center flex-wrap">
                    @foreach ($reviewedPictureBook->family->users as $familyUser)
                    @auth
                    <a href="{{ route('families.bookshelf', ["id" => $reviewedPictureBook->family->id]) }}"
                        class="text-decoration-none">
                        @endauth
                        <span class="btn-group drop-hover">
                            @if ($familyUser->icon_path)
                            <img src="{{ asset($familyUser->icon_path) }}" class="bg-white border" alt="プロフィール画像"
                                style="width: 30px; height:30px;background-position: center;border-radius: 50%;object-fit:cover; margin-right:1px" />
                            @else
                            <i class="far fa-user-circle fa-2x text-secondary"></i>
                            @endif
                            <div class="dropdown-menu p-1 text-center border-linen" style="max-width: 180px">
                                <p class="mb-0">
                                    <b>{{ $familyUser->nickname }}</b>
                                </p>
                                @if ($familyUser->relation !== null)
                                <p class="mb-0">
                                    <span class="badge badge-paper">{{ $familyUser->relation }}</span>
                                </p>
                                @endif
                            </div>
                        </span>
                        @auth
                    </a>
                    @endauth
                    @endforeach
                    @foreach ($reviewedPictureBook->family->children->sortBy('birthday') as $child)
                    @auth
                    <a href="{{ route('families.bookshelf', ["id" => $reviewedPictureBook->family->id]) }}"
                        class="text-decoration-none">
                        @endauth
                        <span class="btn-group drop-hover">
                            @if(Carbon\Carbon::parse($child->birthday)->lte(Carbon\Carbon::now()->subYear())
                            && $child->gender_code === 2)
                            <img src="{{ asset('image/girl.png') }}" alt="プロフィール画像" class="bg-paper border"
                                style="width: 30px; height:30px;background-position: center;border-radius: 50%;object-fit:cover; margin-right:1px" />
                            @elseif(Carbon\Carbon::parse($child->birthday)->lte(Carbon\Carbon::now()->subYear()))
                            <img src="{{ asset('image/boy.png') }}" alt="プロフィール画像" class="bg-paper border"
                                style="width: 30px; height:30px;background-position: center;border-radius: 50%;object-fit:cover; margin-right:1px" />
                            @else
                            <img src="{{ asset('image/baby.png') }}" alt="プロフィール画像" class="bg-paper border"
                                style="width: 30px; height:30px;background-position: center;border-radius: 50%;object-fit:cover; margin-right:1px" />
                            @endif
                            <div class="dropdown-menu dropdown-menu-center p-1 mt-0 text-center border-linen"
                                style="max-width: 180px">
                                @if ($child->family_id === Auth::user()->family_id)
                                <p class="mb-0">
                                    <b>{{ $child->name }}</b>
                                </p>
                                @endif

                                @if ($child->birthday !== null)
                                <p class="mb-0">
                                    {{ Carbon\Carbon::parse($child->birthday)->diff(Carbon\Carbon::now())->format('%y才') }}
                                </p>
                                @endif

                                @if ($child->gender_code === 1)
                                <p class="mb-0">
                                    <span class="badge badge-dark">男の子</span>
                                </p>
                                @elseif ($child->gender_code === 2)
                                <p class="mb-0">
                                    <span class="badge badge-mocha">女の子</span>
                                </p>
                                @endif
                            </div>
                        </span>
                        @auth
                    </a>
                    @endauth
                    @endforeach
                </div>

            </div>
        </div>

        <div class="col-sm-9 d-flex align-items-top">
            <div class="card-body">
                <div class="card-title">
                    <span class="d-flex justify-content-start flex-wrap my-2">
                        <span class="small">
                            @auth
                            <a href="{{ route('families.bookshelf', ["id" => $reviewedPictureBook->family->id]) }}"
                                class="text-dark">
                                @endauth
                                <b>{{ $reviewedPictureBook->family->name }}ファミリー</b>
                                @auth
                            </a>
                            @endauth
                            のレビュー
                        </span>
                        <span
                            class="d-flex flex-wrap ml-auto mr-2 text-muted small">{{ $reviewedPictureBook->updated_at->format('Y年m月d日') }}</span>
                    </span>
                </div>
                {{-- よみきかせ状況 --}}
                <div class="card-text pt-0 pl-0 pb-2 d-flex align-items-end flex-wrap">
                    <span class="small text-secondary mb-0 mr-4">
                        @if ($reviewedPictureBook->read_status === 0)
                        よみきかせ状況：<span class="badge badge-secondary">きになる</span>
                        @elseif($reviewedPictureBook->read_status === 1)
                        よみきかせ状況：<span class="badge badge-teal1">よんだ</span>
                        @endif
                    </span>
                    @if ($reviewedPictureBook->five_star_rating !== 0)
                    <span class="small text-warning">
                        @for ($i = 0; $i < (int)$reviewedPictureBook->five_star_rating; $i++)
                            <i class="fas fa-star"></i>
                            @endfor
                            @for ($i = 0; $i < 5 - (int)$reviewedPictureBook->five_star_rating;
                                $i++)
                                <i class="far fa-star"></i>
                                @endfor
                    </span>
                    @else
                    <span class="text-secondary small">
                        未評価
                    </span>
                    @endif

                    @auth
                    <span class="small ml-auto mr-2">
                        <review-like :initial-is-liked-by='@json($reviewedPictureBook->isLikedBy(Auth::user()))'
                            :initial-count-likes='@json($reviewedPictureBook->count_likes)'
                            :authorized='@json(Auth::check())'
                            endpoint="{{ route('picture_books.like', ['picture_book' => $reviewedPictureBook]) }}">
                        </review-like>
                    </span>
                    @endauth
                </div>

                {{-- レビュー・感想 --}}
                <div class="card-body pt-0 pb-2 pl-0">
                    <p class="card-text" style="font-size: 14px; ">
                        {!! nl2br(e($reviewedPictureBook->review, false)) !!}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
