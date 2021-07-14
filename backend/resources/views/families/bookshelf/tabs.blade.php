<ul class="nav nav-pills nav-justified mt-2">
    <li class="nav-item  bg-white mx-1" style="border-radius: 12px">
        <a href="{{ route('families.bookshelf', ["id" => $family->id]) }}"
            class="nav-link px-1 pt-1 pb-0 btn btn-sm {{ $hasStored ? 'active text-white btn-teal1' : 'btn-outline-teal1' }}"
            style="border-radius: 12px">
            <small>登録絵本</small><br>
            <b>{{ $storedCount }}</b>
        </a>
    </li>
    <li class="nav-item  bg-white mx-1" style="border-radius: 12px">
        <a href="{{ route('families.read', ["id" => $family->id]) }}"
            class="nav-link px-1 pt-1 pb-0 btn btn-sm {{ $hasRead ? 'active text-white btn-teal1' : 'btn-outline-teal1' }}"
            style="border-radius: 12px">
            <small>よんだ絵本</small><br>
            <b>{{ $readCount }}</b>
        </a>
    </li>
    <li class="nav-item bg-white mx-1" style="border-radius: 12px">
        <a href="{{ route('families.curious', ["id" => $family->id]) }}"
            class="nav-link px-1 pt-1 pb-0 btn btn-sm {{ $hasCurious ? 'active text-white btn-teal1' : 'btn-outline-teal1' }}"
            style="border-radius: 12px">
            <small>きになる絵本</small><br>
            <b>{{ $curiousCount }}</b>
        </a>
    </li>
</ul>