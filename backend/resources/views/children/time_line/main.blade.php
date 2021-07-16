@include('children.time_line.tabs', [
'hasReadRecord' => $hasReadRecord,
])

@if ($hasReadRecord) {{-- よんだよ記録 --}}

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

@endif
