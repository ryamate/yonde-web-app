<section class="card shadow-sm my-4">
    <div class="card-body p-0" style="background-color: #E6D7D2">
        <div class="d-flex justify-content-center align-items-end flex-wrap">
            @foreach($pictureBooks as $pictureBook)
            <div class="btn-group drop-hover my-3 px-1">
                <a href="{{ route('families.show', [
                        'id' => $family->id,
                        'picture_book' => $pictureBook,
                        ]) }}" class="">
                    <div class="card-img-top book-cover my-auto">
                        @if ($pictureBook->thumbnail_url !== null)
                        <img src="{{ $pictureBook->thumbnail_url }}" alt="book-cover" class="book-cover-image">
                        @else
                        <img src="{{ asset('image/no_image.png') }}" alt="No Image" class="book-cover-image">
                        @endif
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-center p-0 m-0 shadow">
                    <a href="{{ route('read_records.create', ['picture_book_id' => $pictureBook->id]) }}"
                        class="dropdown-item btn btn-sm bg-teal1 text-center text-white">
                        <i class="fas fa-book-reader mr-1"></i><b>よんだよ</b>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
