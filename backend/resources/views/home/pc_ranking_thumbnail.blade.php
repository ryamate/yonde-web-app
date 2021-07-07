<div class="card border-0 pt-2">
    <a href="{{ route('picture_books.show', ['picture_book' => $pictureBook]) }}" class="text-decoration-none">
        <div class="book-cover my-0">
            @if ($pictureBook->thumbnail_url !== null)
            <img src="{{ $pictureBook->thumbnail_url }}" alt="book-cover" class="book-cover-image">
            @else
            <div class="no-image-background book-cover-image">
                <div class="no-image-title">
                    <div class="ml-3 mr-2">
                        <p class="text-dark text-shadow x-small mb-0" style="line-height:14px;">
                            {{ $pictureBook->title }}
                        </p>
                    </div>
                </div>
            </div>
            @endif

            @include('home.ranking_mark')

        </div>
    </a>
    <div class="card-body p-0 mt-1">
        <a href="{{ route('picture_books.show', ['picture_book' => $pictureBook]) }}"
            class="card-title text-decoration-none">
            <p class="text-teal1 small mb-0" style="line-height:18px;">
                <b>{{ $pictureBook->title }}</b>
            </p>
        </a>
        <a href="{{ route('picture_books.search', ['keyword' => $pictureBook->authors]) }}"
            class=" card-text text-decoration-none">
            @if ($pictureBook->authors !== null)
            <p class="text-dark x-small font-weight-bold mb-0" style="line-height:14px;">
                {{ $pictureBook->authors }}
            </p>
            @endif
        </a>
    </div>
</div>
