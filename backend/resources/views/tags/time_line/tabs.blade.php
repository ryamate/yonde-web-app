<ul class="nav nav-pills nav-justified my-2">
    <li class="nav-item bg-white mx-1" style="border-radius: 12px">
        <a href="{{ route('tags.show', ['name' => $tag->name]) }}"
            class="nav-link px-1 pt-1 pb-0 btn btn-sm {{ $hasTag ? 'active text-white btn-outline-teal1' : 'btn-outline-teal1' }}"
            style="border-radius: 12px">
            <p class="small mb-0">
                みんなの
            </p>
            {{ $tag->hashtag }}
        </a>
    </li>
</ul>
