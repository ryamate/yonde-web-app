<section class="card border-linen shadow-sm my-4">
    <div class="card-body px-0 pt-0 pb-4" style="background-color: #E6D7D2">
        <div
            data-infinite-scroll='{ "path": ".pagination a[rel=next]", "append": ".post", "scrollThreshold": 10, "history": false, "hideNav": ".pagination", "status": ".page-load-status" }'>
            <div class="post">
                <div class="d-flex justify-content-center align-items-end flex-wrap">
                    @foreach($pictureBooks as $pictureBook)
                    <div class="btn-group drop-hover my-3 px-1">

                        <div class="card-img-top book-cover my-auto">
                            @if ($pictureBook->thumbnail_url !== null)
                            <img src="{{ $pictureBook->thumbnail_url }}" alt="book-cover"
                                class="book-cover-image shadow">
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

                        <div class="dropdown-menu dropdown-menu-center p-1 mt-0 text-center border-linen"
                            style="max-width: 180px">
                            <a href="{{ route('families.show', [
                                                    'name' => $family->name,
                                                    'picture_book' => $pictureBook,
                                                    ]) }}"
                                class="dropdown-item btn btn-sm border bg-white text-center text-teal1 mb-1">
                                記録をみる
                            </a>

                            @if ($pictureBook->family_id === Auth::user()->family_id)
                            <a href="{{ route('read_records.create', ['picture_book_id' => $pictureBook->id]) }}"
                                class="dropdown-item btn btn-sm bg-teal1 text-center text-white">
                                <i class="fas fa-book-open mr-1"></i><b>よんだよ</b>
                            </a>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="pagination">
                {{ $pictureBooks->links() }}
            </div>
        </div>
        <div class="page-load-status d-flex justify-content-center">
            <div class="infinite-scroll-request spinner-border text-mocha" role="status" style="display:none;">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>
</section>
