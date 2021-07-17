@include('tags.time_line.tabs', [
'hasTag' => $hasTag,
])


@if (count($readRecords))

@foreach($readRecords as $readRecord)
@if (!$loop->first)
<div class="border-top"></div>
@endif
@include('tags.time_line.message')
@include('tags.time_line.card')
@endforeach
{{ $readRecords->links( 'vendor.pagination.bootstrap-4_teal' ) }}

@else
<p class="alert alert-teal1 border text-muted my-4">
    {{ $tag->hashtag }}の記録はまだありません。
</p>
@endif
