<div class="card border-0 py-2">
    <a href="{{ route('picture_books.show', ['picture_book' => $pictureBook]) }}" class="text-decoration-none">
        <div class="book-cover my-0">
            @if ($pictureBook->thumbnail_url !== null)
            <img src="{{ $pictureBook->thumbnail_url }}" alt="book-cover" class="book-cover-image">
            @else
            <div class="no-image-background book-cover-image">
                <div class="no-image-title">
                    <div class="ml-3 mr-2">
                        <p class="text-white text-shadow x-small mb-0" style="line-height:14px;">
                            no-image
                        </p>
                    </div>
                </div>
            </div>
            @endif
            @include('home.ranking_mark')
        </div>
    </a>
</div>
