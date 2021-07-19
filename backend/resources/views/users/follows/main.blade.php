@include('users.follows.tabs', [
'hasFollowers' => $hasFollowers,
'hasFollowing' => $hasFollowings,
])

@if ($hasFollowers) {{-- フォローしたユーザー --}}

@if (count($followers))

<div
    data-infinite-scroll='{ "path": ".pagination a[rel=next]", "append": ".post", "scrollThreshold": 400, "history": false, "hideNav": ".pagination", "status": ".page-load-status" }'>
    <div class="post">
        @foreach($followers as $family)
        <div class="border-top">
            @include('users.follows.card')
        </div>
        @endforeach
    </div>
    <div class="pagination">
        {{ $followers->links() }}
    </div>
</div>
<div class="page-load-status d-flex justify-content-center">
    <div class="infinite-scroll-request spinner-border text-teal1" role="status" style="display:none;">
        <span class="sr-only">Loading...</span>
    </div>
</div>

@else

<p class="alert alert-teal1 border text-muted my-4">
    本棚のフォロワーはまだいません。
</p>

@endif


@elseif ($hasFollowings) {{-- フォローした本棚 --}}


@if (count($followings))

@foreach($followings as $family)
@if (!$loop->first)
<div class="border-top"></div>
@endif
@include('users.follows.card')
@endforeach
{{ $followings->links( 'vendor.pagination.bootstrap-4_teal' ) }}

@else

<p class="alert alert-teal1 border text-muted my-4">
    本棚のフォローはまだしていません。
</p>

@endif

@endif
