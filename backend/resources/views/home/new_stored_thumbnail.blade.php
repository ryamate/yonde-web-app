<div class="pb-4">
    <div class="mx-2 mt-2 mb-4">
        <a role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
            onclick="location.href='{{ route('picture_books.show', ['picture_book' => $pictureBook]) }}'">
            <div class="card-img-top book-cover my-auto">
                @if ($pictureBook->thumbnail_url !== null)
                <img src="{{ $pictureBook->thumbnail_url }}" alt="book-cover" class="book-cover-image shadow">
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
    </div>
</div>
