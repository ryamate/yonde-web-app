<section class="card shadow-sm my-4">
    <div class="card-body p-0" style="background-color: #E6D7D2">
        <div class="d-flex justify-content-center align-items-end flex-wrap">
            @foreach($pictureBooks as $pictureBook)
            <div class="btn-group drop-hover my-3 px-1">
                <a href="{{ route('families.show', [
                        'id' => $family->id,
                        'picture_book' => $pictureBook,
                        ]) }}" class="text-decoration-none">
                    <div class="card-img-top book-cover my-auto">
                        @if ($pictureBook->thumbnail_url !== null)
                        <img src="{{ $pictureBook->thumbnail_url }}" alt="book-cover" class="book-cover-image">
                        @else
                        <div class="no-image-background book-cover-image" style="width: 128px">
                            <div class="no-image-title">
                                <div class="ml-3 mr-2">
                                    <p class="text-dark text-shadow x-small mb-0" style="line-height:14px;">
                                        {{ $pictureBook->title }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </a>
                @if ($pictureBook->family_id === Auth::user()->family_id)
                <div class=" dropdown-menu dropdown-menu-center p-0 m-0 shadow">
                    <a href="{{ route('read_records.create', ['picture_book_id' => $pictureBook->id]) }}"
                        class="dropdown-item btn btn-sm bg-teal1 text-center text-white">
                        <i class="fas fa-book-reader mr-1"></i><b>よんだよ</b>
                    </a>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
