<div class="card-body pb-0">
    <div class="row no-gutters">
        <div class="col-sm-6 p-2">
            <p class="card-title">
                {{ $tag->hashtag }}
            </p>
        </div>

        <div class="col-sm-6 p-2">
            <div class="card-text text-right">
                {{ $tag->readRecords->count() }}件
            </div>

        </div>
    </div>
</div>
