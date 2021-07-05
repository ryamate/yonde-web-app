<div class="pb-4">
    <div class="dropdown drop-hover mx-2 mt-2 mb-4">
        <a role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
            onclick="location.href='{{ route('picture_books.show', ['picture_book' => $pictureBook]) }}'">
            <div class="card-img-top book-cover my-auto">
                @if ($pictureBook->thumbnail_url !== null)
                <img src="{{ $pictureBook->thumbnail_url }}" alt="book-cover" class="book-cover-image">
                @else
                <div class="no-image-background book-cover-image" style="width: 128px">
                    <div class="no-image-title">
                        <div class="ml-3 mr-2">
                            <p class="text-shadow x-small mb-0" style="line-height:14px;">
                                {{ $pictureBook->title }}
                            </p>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </a>

        <div class=" dropdown-menu p-0 m-0 shadow" aria-labelledby="dropdownMenuLink">
            <a href="{{ route('picture_books.show', ['picture_book' => $pictureBook]) }}"
                class="dropdown-item card-title text-decoration-none px-2 py-0 m-0">
                <p class="text-truncate text-teal1 x-small mb-0" style="line-height:14px; max-width:150px;">
                    <b>{{ $pictureBook->title }}</b>
                </p>
            </a>
            <a href="{{ route('picture_books.search', ['keyword' => $pictureBook->authors]) }}"
                class="dropdown-item card-text text-decoration-none px-2 py-0 m-0">
                @if ($pictureBook->authors !== null)
                <p class="text-truncate text-dark x-small mb-0" style="line-height:14px; max-width:150px;">
                    {{ $pictureBook->authors }}
                </p>
                @endif
            </a>
        </div>
    </div>
</div>
