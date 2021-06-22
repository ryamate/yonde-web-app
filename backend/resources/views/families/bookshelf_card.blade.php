<section class="card shadow-sm my-4">
    <div class="card-body p-0" style="background-color: #E6D7D2">
        <div class="row no-gutters">
            @foreach($pictureBooks as $pictureBook)
            <div class="col-4 col-sm-2 d-flex align-items-end">
                <div class="card border-0" style="background-color: transparent">
                    <div class="card-body py-0 px-1">
                        <a href="{{ route('picture_books.show', ['picture_book' => $pictureBook]) }}">
                            <div class="book-cover">
                                @if ($pictureBook->thumbnail_url !== null)
                                <img src="{{ $pictureBook->thumbnail_url }}" alt="book-cover" class="book-cover-image">
                                @else
                                <img src="{{ asset('image/no_image.png') }}" alt="No Image" class="book-cover-image">
                                @endif
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
