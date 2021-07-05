<div class="row no-gutters">
    <div class="col-sm-4">
        <div class="card-body py-0">
            <div class="book-cover">
                @if ($pictureBook->thumbnail_url !== null)
                <img src="{{ $pictureBook->thumbnail_url }}" alt="book-cover" class="book-cover-image">
                @else
                <div class="no-image-background book-cover-image">
                    <div class="no-image-title">
                        <div class="ml-3 mr-2">
                            <span class="text-shadow x-small">
                                {{ $pictureBook->title }}
                            </span>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-sm-8 d-flex align-items-center justify-content-center">
        <div class="card-body py-0">
            <div class="card-title">
                <h5 class="font-weight-lighter">
                    {{ $pictureBook->title }}
                </h5>
            </div>
            <div class="card-text">
                <p class="font-weight-lighter">
                    @if ($pictureBook->authors !== null)
                    {{ $pictureBook->authors }}
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>
