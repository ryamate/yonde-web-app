@include('users.time_line.tabs', [
'hasStored' => $hasStored,
'hasReadRecord' => $hasReadRecord,
'hasLikes' => $hasLikes,
])

@if ($hasStored) {{-- 登録絵本 --}}

@if (count($pictureBooks))

<div
    data-infinite-scroll='{ "path": ".pagination a[rel=next]", "append": ".post", "scrollThreshold": 400, "history": false, "hideNav": ".pagination", "status": ".page-load-status" }'>
    <div class="post">
        @foreach($pictureBooks as $pictureBook)
        <div class="border-top">
            @include('families.time_line.stored_picture_books.message')
            @include('families.time_line.stored_picture_books.card')
        </div>
        @endforeach
    </div>
    <div class="pagination">
        {{ $pictureBooks->links() }}
    </div>
</div>
<div class="page-load-status d-flex justify-content-center">
    <div class="infinite-scroll-request spinner-border text-teal1" role="status" style="display:none;">
        <span class="sr-only">Loading...</span>
    </div>
</div>

@else
<p class="alert alert-teal1 border text-muted my-4">
    登録はまだありません。
</p>
@endif

@elseif ($hasReadRecord) {{-- よんだよ記録 --}}

@if (count($readRecords))

<div
    data-infinite-scroll='{ "path": ".pagination a[rel=next]", "append": ".post", "scrollThreshold": 400, "history": false, "hideNav": ".pagination", "status": ".page-load-status" }'>
    <div class="post">
        @foreach($readRecords as $readRecord)
        <div class="border-top">
            @include('families.time_line.read_records.message')
            @include('families.time_line.read_records.card')
        </div>
        @endforeach
    </div>
    <div class="pagination">
        {{ $readRecords->links() }}
    </div>
</div>
<div class="page-load-status d-flex justify-content-center">
    <div class="infinite-scroll-request spinner-border text-teal1" role="status" style="display:none;">
        <span class="sr-only">Loading...</span>
    </div>
</div>
@else
<p class="alert alert-teal1 border text-muted my-4">
    記録はまだありません。
</p>
@endif

@elseif ($hasLikes) {{-- いいねしたレビュー --}}

@if (count($pictureBooks))

<div
    data-infinite-scroll='{ "path": ".pagination a[rel=next]", "append": ".post", "scrollThreshold": 400, "history": false, "hideNav": ".pagination", "status": ".page-load-status" }'>
    <div class="post">
        @foreach($pictureBooks as $pictureBook)
        <div class="border-top">
            @include('users.time_line.likes.message')
            @include('families.time_line.stored_picture_books.card')
        </div>
        @endforeach
    </div>
    <div class="pagination">
        {{ $pictureBooks->links() }}
    </div>
</div>
<div class="page-load-status d-flex justify-content-center">
    <div class="infinite-scroll-request spinner-border text-teal1" role="status" style="display:none;">
        <span class="sr-only">Loading...</span>
    </div>
</div>
@else
<p class="alert alert-teal1 border text-muted my-4">
    いいねしたレビューはまだありません。
</p>
@endif
@endif
