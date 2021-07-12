<div class="pt-4 pb-1">
    <a href="{{ route('users.index', ['name' => $pictureBook->user->name]) }}">
        @if ($pictureBook->user->icon_path)
        <img src="{{ asset($pictureBook->user->icon_path) }}" class="border" alt="プロフィール画像" style="width:25px; height:25px;background-position: center
                                            center;border-radius: 50%;object-fit:cover;">
        @else
        <i class="far fa-user-circle text-secondary"></i>
        @endif
        <span class="text-teal1 small">
            {{ ' ' . $pictureBook->user->nickname}}
        </span>
    </a>
    @if ($pictureBook->created_at == $pictureBook->updated_at)
    <span class="text-muted small">
        さんが『
        <a href="{{ route('families.show', ['id' => Auth::user()->family_id, 'picture_book' => $pictureBook]) }}"
            class="card-title text-teal1">
            <b>{{ $pictureBook->title }}</b>
        </a>
        』を本棚に登録しました。
    </span>
    @else
    <span class="text-muted small">
        さんが本棚の『
        <a href="{{ route('families.show', ['id' => Auth::user()->family_id, 'picture_book' => $pictureBook]) }}"
            class="card-title text-teal1">
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
