<div class="card-body pb-0">
    <div class="row no-gutters">
        <div class="col-sm-6 p-2">
            <p class="card-title d-flex align-items-center flex-wrap">
                <a href="{{ route('families.bookshelf', ["name" => $family->name]) }}"
                    class="text-dark font-weight-bold">
                    {{ $family->nickname }}ファミリー
                </a>
                <span class="d-flex ml-3" title="お気に入り本棚">
                    @if( Auth::user()->family_id !== $family->id )
                    <follow-button class="ml-auto" :initial-is-followed-by='@json($family->isFollowedBy(Auth::user()))'
                        :authorized='@json(Auth::check())'
                        endpoint="{{ route('families.follow', ['name' => $family->name]) }}">
                    </follow-button>
                    @endif
                </span>
            </p>
            <p class="small text-secondary mb-1">
                家族一覧
            </p>
            <div class="d-flex justify-content-start align-items-center flex-wrap">
                @foreach ($familyUsers as $familyUser)
                <span class="btn-group drop-hover">
                    @if ($familyUser->icon_path)
                    <img src="{{ asset($familyUser->icon_path) }}" class="bg-white border" alt="プロフィール画像"
                        style="width: 45px; height:45px;background-position: center;border-radius: 50%;object-fit:cover; margin-right:1px" />
                    @else
                    <i class="far fa-user-circle fa-3x text-secondary"></i>
                    @endif
                    <div class="dropdown-menu dropdown-menu-center p-1 mt-0 text-center border-linen"
                        style="max-width: 180px">
                        <a href="{{ route("users.index", ["name" => $familyUser->name]) }}"
                            class="text-teal1 font-weight-bold">
                            <p class="mb-0">
                                {{ $familyUser->nickname }}
                            </p>
                        </a>
                        @if ($familyUser->relation !== null)
                        <p class="mb-0">
                            <span class="badge badge-paper">{{ $familyUser->relation }}</span>
                        </p>
                        @endif
                    </div>
                </span>
                @endforeach

                @foreach ($children as $child)
                <span class="btn-group drop-hover">

                    @if(Carbon\Carbon::parse($child->birthday)->lte(Carbon\Carbon::now()->subYear())
                    && $child->gender_code === 2)
                    <img src="{{ asset('image/girl.png') }}" alt="プロフィール画像" class="bg-paper border"
                        style="width: 45px; height:45px;background-position: center;border-radius: 50%;object-fit:cover; margin-right:1px" />
                    @elseif(Carbon\Carbon::parse($child->birthday)->lte(Carbon\Carbon::now()->subYear()))
                    <img src="{{ asset('image/boy.png') }}" alt="プロフィール画像" class="bg-paper border"
                        style="width: 45px; height:45px;background-position: center;border-radius: 50%;object-fit:cover; margin-right:1px" />
                    @else
                    <img src="{{ asset('image/baby.png') }}" alt="プロフィール画像" class="bg-paper border"
                        style="width: 45px; height:45px;background-position: center;border-radius: 50%;object-fit:cover; margin-right:1px" />
                    @endif
                    <div class="dropdown-menu dropdown-menu-center p-1 mt-0 text-center border-linen"
                        style="max-width: 180px">
                        <a href="{{ route('children.show', ['id' => $child->id]) }}" class="text-teal1">
                            @if ($child->family_id === Auth::user()->family_id)
                            <p class="font-weight-bold mb-0">
                                {{ $child->name }}
                            </p>
                            @endif

                            @if ($child->birthday !== null)
                            <p class="text-dark mb-0">
                                {{ Carbon\Carbon::parse($child->birthday)->diff(Carbon\Carbon::now())->format('%y才') }}
                            </p>
                            @endif
                        </a>

                        @if ($child->gender_code === 1)
                        <p class="mb-0">
                            <span class="badge badge-dark-mocha">男の子</span>
                        </p>
                        @elseif ($child->gender_code === 2)
                        <p class="mb-0">
                            <span class="badge badge-mocha">女の子</span>
                        </p>
                        @endif
                    </div>
                </span>
                @endforeach
            </div>
        </div>

        <div class="col-sm-6 p-2">
            <p class="small">
                {!! nl2br(e($family->introduction, false)) !!}
            </p>
            <div class="row no-gutters">
                <div class="col-4 text-center">
                    <p class="small mb-0">
                        登録絵本
                    </p>
                    <p class="mb-0">
                        <a href="{{ route('families.index', ["name" =>  $family->name]) }}" class="text-dark">
                            {{ $storedCount }}
                            <span class="x-small">冊</span>
                        </a>
                    </p>
                </div>
                <div class="col-4 text-center">
                    <p class="small mb-0">
                        よんだよ
                    </p>
                    <p class="mb-0">
                        <a href="{{ route('families.read_record', ["name" =>  $family->name]) }}" class="text-dark">
                            {{ $readRecordCount }}
                            <span class="x-small">回</span>
                        </a>
                    </p>
                </div>
                <div class="col-4 text-center">
                    <p class="small mb-0">
                        レビュー
                    </p>
                    <p class="mb-0">
                        {{ $reviewCount }}
                        <span class="x-small">件</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
