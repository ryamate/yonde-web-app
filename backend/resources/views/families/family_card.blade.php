<div class="card-body pb-0">
    <div class="row no-gutters">
        <div class="col-sm-6 p-2">
            <p class="card-title text-secondary">
                <b>{{ $family->name }}ファミリー</b>
            </p>
            <div class="d-flex justify-content-start align-items-center flex-wrap p-2">
                @foreach ($familyUsers as $familyUser)
                <a href="{{ route("users.show", ["name" => $familyUser->name]) }}" class="text-decoration-none px-1"
                    title="{{ $familyUser->nickname }}/{{ $familyUser->relation }}">
                    @if ($familyUser->icon_path)
                    <img src="{{ asset($familyUser->icon_path) }}" class="bg-white border" alt="プロフィール画像"
                        style="width: 45px; height:45px;background-position: center;border-radius: 50%;object-fit:cover;" />
                    @else
                    <i class="far fa-user-circle fa-3x text-teal1"></i>
                    @endif
                </a>
                @endforeach

                @foreach ($children as $child)
                <a href="{{ route('children.show', ['id' => $child->id]) }}" class="text-decoration-none"
                    title="{{ $child->name }}/{{ ($child->birthday !== null) ? Carbon\Carbon::parse($child->birthday)->diff(Carbon\Carbon::now())->format('%y歳') : '' }}">
                    <span class="fa-stack fa-lg text-teal1">
                        <i class="far fa-circle fa-stack-2x"></i>
                        @if (Carbon\Carbon::parse($child->birthday)->lte(Carbon\Carbon::now()->subYear()))
                        <i class="fas fa-child fa-stack-1x"></i>
                        @else
                        <i class="fas fa-baby fa-stack-1x"></i>
                        @endif
                    </span>
                </a>
                @endforeach
            </div>
        </div>

        <div class="col-sm-6 p-2">
            <p class="small text-dark">
                {{ $family->introduction }}
            </p>
            <div class="row no-gutters">
                <div class="col-3 text-center">
                    <p class="small text-secondary mb-0">
                        登録絵本
                    </p>
                    <p class="mb-0">
                        <a href="" class="text-decoration-none text-teal1">
                            {{ $storedCount }}
                        </a>
                    </p>
                </div>
                <div class="col-3 text-center">
                    <p class="small text-secondary mb-0">
                        よんだよ
                    </p>
                    <p class="mb-0">
                        <a href="" class="text-decoration-none text-teal1">
                            {{ $readRecordCount }}
                        </a>
                    </p>
                </div>
                <div class="col-3 text-center">
                    <p class="small text-secondary mb-0">
                        レビュー
                    </p>
                    <p class="mb-0">
                        <a href="" class="text-decoration-none text-teal1">
                            {{ $reviewCount }}
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
