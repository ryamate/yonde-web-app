<div class="card mt-3">
    <div class="card-body">
        <div class="row no-gutters">
            <div class="col-sm-6 p-2">
                <p>
                    {{ $family->name }}ファミリーのタイムライン
                </p>
                <p class="small text-secondary">
                    {{ $family->introduction }}
                </p>
            </div>

            <div class="col-sm-6 p-2">
                <p class="small text-secondary mb-0">家族一覧</p>
                <div class="row no-gutters mb-2">
                    @foreach ($familyUsers as $familyUser)
                    <div class="col-sm-4">
                        <a href="{{ route("users.show", ["name" => $familyUser->name]) }}">
                            @if ($familyUser->icon_path)
                            <img src="{{ asset($familyUser->icon_path) }}" alt="プロフィール画像"
                                style="width: 30px; background-position: center center;object-fit:cover;">
                            @else
                            <i class="far fa-user-circle fa-lg text-secondary"></i>
                            @endif
                        </a>
                        <a href="{{ route("users.show", ["name" => $familyUser->name]) }}"
                            class="card-text text-teal1 text-decoration-none small">
                            {{ $familyUser->nickname }}
                        </a>
                        <span class="card-text small text-secondary">
                            /{{ $familyUser->relation }}
                        </span>
                    </div>
                    @endforeach
                </div>

                <p class="small text-secondary mb-0">お子さま一覧</p>
                <div class="row no-gutters mb-2">
                    @foreach ($children as $child)
                    <div class="col-sm-4">
                        @if (Carbon\Carbon::parse($child->birthday)->lte(Carbon\Carbon::now()->subYear()))
                        <i class="fas fa-child fa-lg text-secondary"></i>
                        @else
                        <i class="fas fa-baby fa-lg text-secondary"></i>
                        @endif
                        <a href="{{ route('children.show', ['id' => $child->id]) }}"
                            class="card-text text-teal1 text-decoration-none small">
                            {{ $child->name }}
                        </a>
                        <span class="card-text small text-secondary">
                            @if ($child->birthday !== null)
                            /
                            {{ Carbon\Carbon::parse($child->birthday)->diff(Carbon\Carbon::now())->format('%y歳') }}
                            @endif
                        </span>
                    </div>
                    @endforeach
                </div>

                <div class="row no-gutters">
                    <div class="col-4 text-center">
                        <p class="small text-secondary mb-0">
                            登録絵本
                        </p>
                        <p class="mb-0">
                            <a href="" class="text-decoration-none text-teal1">
                                123
                            </a>
                        </p>
                    </div>
                    <div class="col-4 text-center">
                        <p class="small text-secondary mb-0">
                            よんだよ
                        </p>
                        <p class="mb-0">
                            <a href="" class="text-decoration-none text-teal1">
                                123
                            </a>
                        </p>
                    </div>
                    <div class="col-4 text-center">
                        <p class="small text-secondary mb-0">
                            レビュー
                        </p>
                        <p class="mb-0">
                            <a href="" class="text-decoration-none text-teal1">
                                123
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
