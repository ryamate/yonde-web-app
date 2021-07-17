<ul class="nav nav-pills nav-justified my-2">
    <li class="nav-item bg-white mx-1" style="border-radius: 12px">
        <a href="{{ route('children.show', ["id" =>  $child->id]) }}"
            class="nav-link px-1 pt-1 pb-0 btn btn-sm {{ $hasReadRecord ? 'active text-white btn-outline-teal1' : 'btn-outline-teal1' }}"
            style="border-radius: 12px">
            <small>よんだよ記録</small><br>
            <b>{{ $readRecordCount }}</b>
        </a>
    </li>
</ul>
