<div class="d-flex flex-wrap pt-4 pb-1">
    <span class="d-flex flex-wrap mr-1 text-muted small">
        <a href="">
            <span class="text-teal1">
                <b>{{ $pictureBook->family->name}}ファミリー</b>
            </span>
        </a>
        の『
        <a href="" class="text-teal1">
            <b>{{ $pictureBook->title }}</b>
        </a>
        』のレビューをいいねしました。
    </span>

    <span class="ml-auto text-muted small">
        @if (Carbon\Carbon::parse($pictureBook->pivot->updated_at)->diffInDays(now()) == 0)
        今日
        {{ $pictureBook->pivot->updated_at->format('H:m') }}

        @elseif (Carbon\Carbon::parse($pictureBook->pivot->updated_at)->diffInDays(now()) <= 7 )
            {{ Carbon\Carbon::parse($pictureBook->pivot->updated_at)->diffInDays(now()) }}日前 @else
            {{ $pictureBook->pivot->updated_at->format('Y年m月d日') }} @endif </span> </div>
