<div class="pt-4 pb-1">
    <a href="{{ route('users.show', ['name' => $readRecord->user->name]) }}" class="text-dark">
        @if ($readRecord->user->icon_path)
        <img src="{{ asset($readRecord->user->icon_path) }}" class="border" alt="プロフィール画像" style="width:25px; height:25px;background-position: center
                            center;border-radius: 50%;object-fit:cover;">
        @else
        <i class="far fa-user-circle fa-1x"></i>
        @endif
        <span class="text-teal1 small">
            {{ ' ' . $readRecord->user->nickname}}
        </span>
    </a>
    @if ($readRecord->pictureBook->created_at == $readRecord->pictureBook->updated_at)
    <span class="text-muted small">
        さんが『
        <a href="{{ route('families.show', [
                        'id' => $family->id,
                        'picture_book' => $readRecord->pictureBook,
                        ]) }}" class="card-title text-teal1"><b>{{ $readRecord->pictureBook->title }}</b></a>
        』の読み聞かせ記録をしました。
    </span>
    @else
    <span class="text-muted small">
        さんが『
        <a href="{{ route('families.show', [
                        'id' => $family->id,
                        'picture_book' => $readRecord->pictureBook,
                        ]) }}" class="card-title text-teal1"><b>{{ $readRecord->pictureBook->title }}</b></a>
        』の読み聞かせ記録を更新しました。
    </span>
    @endif

    <span class="text-muted small">
        @if (Carbon\Carbon::parse($readRecord->updated_at)->diffInDays(now()) == 0)
        (今日)
        @else
        ({{ Carbon\Carbon::parse($readRecord->updated_at)->diffInDays(now()) }}日前)
        @endif
    </span>
</div>
