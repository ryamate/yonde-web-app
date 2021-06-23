<ul class="nav nav-pills nav-justified mt-3">
    <li class="nav-item">
        <a href="{{ route('families.bookshelf', ["id" => Auth::user()->family_id]) }}"
            class="nav-link px-1 mx-1 pt-1 pb-0 shadow-sm btn btn-sm {{ $hasStored ? 'active text-white btn-teal1' : 'btn-outline-teal1' }}"
            style="border-radius: 12px">
            <small>登録絵本</small><br>
            <b>{{ $storedCount }}</b>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link px-1 mx-1 pt-1 pb-0 shadow-sm btn btn-sm {{ $hasCurious ? 'active text-white btn-teal1' : 'btn-outline-teal1' }}"
            href="{{ route('families.curious', ["id" => Auth::user()->family_id]) }}" style="border-radius: 12px">
            <small>きになる絵本</small><br>
            <b>{{ $curiousCount }}</b>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link px-1 mx-1 pt-1 pb-0 shadow-sm btn btn-sm {{ $hasRead ? 'active text-white btn-teal1' : 'btn-outline-teal1' }}"
            href="{{ route('families.read', ["id" => Auth::user()->family_id]) }}" style="border-radius: 12px">
            <small>よんだ絵本</small><br>
            <b>{{ $readCount }}</b>
        </a>
    </li>
</ul>
