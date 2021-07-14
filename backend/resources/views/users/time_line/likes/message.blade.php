<div class="d-flex align-items-center flex-wrap pt-4 pb-1">
    <span class="small text-muted">
        <i class="far fa-thumbs-up mr-1"></i>
        <a href="">
            <span class="text-teal1">
                <b>{{ $pictureBook->family->name}}ファミリー</b>
            </span>
        </a>
        の
    </span>
    <span class="small text-muted">
        『
        <a href="" class="text-teal1">
            <b>{{ $pictureBook->title }}</b>
        </a>
        』
    </span>
    <span class="small text-muted">
        のレビューをいいねしました。
    </span>

    <span class="ml-auto text-muted small">
        @if (Carbon\Carbon::parse($pictureBook->pivot->updated_at)->diffInDays(now()) == 0)
        {{ Carbon\Carbon::parse($pictureBook->pivot->updated_at)->diffInHours(now()) }}時間前

        @else
        {{ $pictureBook->pivot->updated_at->format('Y年m月d日') }}
        @endif
    </span>
</div>
