<div class="card-body p-2">
    <ul class="nav nav-pills nav-justified">
        <li class="nav-item">
            <a class="nav-link px-1 mx-1 py-1 btn btn-sm {{ $hasBookshelf ? 'active text-white btn-secondary' : 'btn-outline-secondary' }}"
                href="{{ route('families.bookshelf', ["id" => $family->id]) }}">
                <i class="fas fa-book mr-1"></i>本棚
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-1 mx-1 py-1 btn btn-sm {{ $hasPictureBooks ? 'active text-white btn-secondary ' : 'btn-outline-secondary' }}"
                href="{{ route('families.index', ["id" => $family->id]) }}">
                <i class="far fa-clock mr-1"></i>タイムライン
            </a>
        </li>
    </ul>
</div>
