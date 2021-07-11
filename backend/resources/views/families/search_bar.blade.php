<div class="card mt-4">
    <div class="card-body pt-3 pb-0">
        <div class="card-text">
            <form action="{{ route('picture_books.search_bookshelf') }}" method="GET">
                @csrf
                <div class="row">
                    <div class="col-10">
                        <div class="form-group">
                            <bookshelf-tags-input :autocomplete-items='@json($pictureBookNames ?? [])'>
                            </bookshelf-tags-input>
                        </div>
                    </div>
                    <div class="col-2 pl-0">
                        <button class="btn border bg-white text-teal1" type="submit" id="search">
                            <i class="fas fa-search"></i>
                    </div>
                </div>
                </button>
            </form>
        </div>
    </div>
</div>
