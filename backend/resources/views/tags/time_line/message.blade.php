<div class="d-flex align-items-center flex-wrap pt-4 pb-1">
    <span>
        <a href="{{ route('users.index', ['name' => $readRecord->user->name]) }}" class="text-teal1">
            @if ($readRecord->user->icon_path)
            <img src="{{ asset($readRecord->user->icon_path) }}" class="border" alt="プロフィール画像" style="width:25px; height:25px;background-position: center
                            center;border-radius: 50%;object-fit:cover;">
            @else
            <i class="far fa-user-circle text-secondary"></i>
            @endif
            <span class="small">
                {{ ' ' . $readRecord->user->nickname}}
            </span>
        </a>
        <span class="text-muted small">
            さんが
        </span>
    </span>
    @if ($readRecord->pictureBook->created_at == $readRecord->pictureBook->updated_at)
    <span class="text-muted small">
        『
        <a href="{{ route('families.show', [
                        'id' => $readRecord->family_id,
                        'picture_book' => $readRecord->pictureBook,
                        ]) }}" class="card-title text-teal1"><b>{{ $readRecord->pictureBook->title }}</b></a>
        』
    </span>
    <span class="text-muted small">
        の読み聞かせ記録をしました。
    </span>
    @else
    <span class="text-muted small">
        『
        <a href="{{ route('families.show', [
                        'id' => $readRecord->family_id,
                        'picture_book' => $readRecord->pictureBook,
                        ]) }}" class="card-title text-teal1"><b>{{ $readRecord->pictureBook->title }}</b></a>
        』
    </span>
    <span class="text-muted small">
        の読み聞かせ記録を更新しました。
    </span>
    @endif

    <span class="ml-auto text-muted small">
        @if (Carbon\Carbon::parse($readRecord->updated_at)->diffInDays(now()) == 0)
        {{ Carbon\Carbon::parse($readRecord->updated_at)->diffInHours(now()) }}時間前

        @else
        {{ $readRecord->updated_at->format('Y年m月d日') }}
        @endif
    </span>
</div>
