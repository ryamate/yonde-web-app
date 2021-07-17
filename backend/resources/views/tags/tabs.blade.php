<div class="card-body p-2">
    <ul class="nav nav-pills nav-justified">
        <li class="nav-item">
            <a href="{{ route('tags.show', ['name' => $tag->name]) }}"
                class="nav-link px-1 mx-1 py-1 btn btn-sm {{ $hasTimeLine ? 'active text-white btn-teal1 ' : 'btn-outline-secondary' }}">
                <i class="far fa-clock mr-1"></i>タイムライン
            </a>
        </li>
    </ul>
</div>
