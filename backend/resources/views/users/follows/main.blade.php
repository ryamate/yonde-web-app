@include('users.follows.tabs', [
'hasFollowers' => $hasFollowers,
'hasFollowing' => $hasFollowings,
])

@if ($hasFollowers) {{-- フォローしたユーザー --}}

@if (count($followers))

@foreach($followers as $family)
@if (!$loop->first)
<div class="border-top"></div>
@endif
@include('users.follows.card')
@endforeach
{{ $followers->links( 'vendor.pagination.bootstrap-4_teal' ) }}

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
