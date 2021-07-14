@include('users.time_line.tabs', [
'hasStored' => $hasStored,
'hasReadRecord' => $hasReadRecord,
'hasLikes' => $hasLikes,
])

@if ($hasStored) {{-- 登録絵本 --}}

@if (count($pictureBooks))

@foreach($pictureBooks as $pictureBook)
@if (!$loop->first)
<div class="border-top"></div>
@endif
@include('families.time_line.stored_picture_books.message')
@include('families.time_line.stored_picture_books.card')
@endforeach
{{ $pictureBooks->links( 'vendor.pagination.bootstrap-4_teal' ) }}

@else
<p class="alert alert-teal1 border text-muted my-4">
    登録はまだありません。
</p>
@endif

@elseif ($hasReadRecord) {{-- よんだよ記録 --}}

@if (count($readRecords))

@foreach($readRecords as $readRecord)
@if (!$loop->first)
<div class="border-top"></div>
@endif
@include('families.time_line.read_records.message')
@include('families.time_line.read_records.card')
@endforeach
{{ $readRecords->links( 'vendor.pagination.bootstrap-4_teal' ) }}

@else
<p class="alert alert-teal1 border text-muted my-4">
    記録はまだありません。
</p>
@endif

@elseif ($hasLikes) {{-- いいねしたレビュー --}}

@if (count($pictureBooks))

@foreach($pictureBooks as $pictureBook)
@if (!$loop->first)
<div class="border-top"></div>
@endif
@include('users.time_line.likes.message')
@include('families.time_line.stored_picture_books.card')
@endforeach
{{ $pictureBooks->links( 'vendor.pagination.bootstrap-4_teal' ) }}

@else
<p class="alert alert-teal1 border text-muted my-4">
    いいねしたレビューはまだありません。
</p>
@endif
@endif
