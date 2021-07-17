<div class="d-flex align-items-center flex-wrap pt-4 pb-1">
    <span>
        <a href="{{ route('users.index', ['name' => $pictureBook->user->name]) }}" class="text-teal1">
            @if ($pictureBook->user->icon_path)
            <img src="{{ asset($pictureBook->user->icon_path) }}" class="border" alt="プロフィール画像" style="width:25px; height:25px;background-position: center
                                            center;border-radius: 50%;object-fit:cover;">
            @else
            <i class="far fa-user-circle text-muted"></i>
            @endif
            <span class="small">
                {{ ' ' . $pictureBook->user->nickname}}
            </span>
        </a>
        <span class="text-muted small">
            さんが
        </span>
    </span>
    @if ($pictureBook->created_at == $pictureBook->updated_at)
    <span class="text-muted small">
        『
        <a href="{{ route('families.show', ['name' => Auth::user()->family->name, 'picture_book' => $pictureBook]) }}"
            class="card-title text-teal1">
            <b>{{ $pictureBook->title }}</b>
        </a>
        』
    </span>
    <span class="text-muted small">
        を本棚に登録しました。
    </span>
    @else
    <span class="text-muted small">
        本棚の『
        <a href="{{ route('families.show', ['name' => Auth::user()->family->name, 'picture_book' => $pictureBook]) }}"
            class="card-title text-teal1">
            <b>{{ $pictureBook->title }}</b>
        </a>
        』
    </span>
    <span class="text-muted small">
        を更新しました。
    </span>
    @endif

    <span class="text-muted small ml-auto">
        @if (Carbon\Carbon::parse($pictureBook->updated_at)->diffInDays(now()) == 0)
        {{ Carbon\Carbon::parse($pictureBook->updated_at)->diffInHours(now()) }}時間前

        @else
        {{ $pictureBook->updated_at->format('Y年m月d日') }}
        @endif
    </span>
</div>
