<div class="card-body p-2">
    <ul class="nav nav-pills nav-justified">
        {{-- <li class="nav-item">
            <a href=""
                class="nav-link px-1 mx-1 py-1 btn btn-sm {{ $hasFollows ? 'active text-white btn-secondary' : 'btn-outline-secondary' }}">
        <i class="fas fa-book mr-1"></i>本棚フォロー
        </a>
        </li> --}}
        <li class="nav-item">
            <a href="{{ route('children.show', ["id" => $child->id]) }}"
                class="nav-link px-1 mx-1 py-1 btn btn-sm {{ $hasTimeLine ? 'active text-white btn-secondary ' : 'btn-outline-secondary' }}">
                <i class="far fa-clock mr-1"></i>タイムライン
            </a>
        </li>
    </ul>
</div>
