<div class="pb-4">
    <div class="dropdown drop-hover mx-2 mb-4 pt-2 pb-1">
        <a role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
            onclick="location.href='{{ route('picture_books.show', ['picture_book' => $pictureBook]) }}'">
            <div class="card-img-top book-cover my-auto">
                @if ($pictureBook->thumbnail_url !== null)
                <img src="{{ $pictureBook->thumbnail_url }}" alt="book-cover" class="book-cover-image">
                @else
                <img src="{{ asset('image/no_image.png') }}" alt="No Image" class="book-cover-image">
                @endif
            </div>
        </a>

        <div class="dropdown-menu dropdown-menu-center p-0 m-0 shadow text-center" aria-labelledby="dropdownMenuLink">
            <a href="{{ route('picture_books.show', ['picture_book' => $pictureBook]) }}"
                class="dropdown-item card-title text-decoration-none px-2 py-0 m-0">
                <p class="text-truncate text-dark x-small mb-0" style="line-height:14px; max-width:150px;">
                    <b>{{ $pictureBook->title }}</b>
                </p>
            </a>
            <a href="" class="dropdown-item card-text text-decoration-none px-2 py-0 m-0">
                @if ($pictureBook->authors !== null)
                <p class="text-truncate text-teal1 x-small mb-0" style="line-height:14px; max-width:150px;">
                    {{ $pictureBook->authors }}
                </p>
                @endif
            </a>
        </div>
    </div>
</div>
