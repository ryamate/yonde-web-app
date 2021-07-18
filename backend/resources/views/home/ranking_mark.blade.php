@if ($loop->first)
<div class="card-img-overlay-ranking">
    <span class="fa-stack fa-1x">
        <span class="fa fa-bookmark fa-stack-2x text-lemon-tea"></span>
        <span class="fa fa-stack-1x text-white small">1</span>
    </span>
</div>
@elseif ($loop->iteration === 2)
<div class="card-img-overlay-ranking">
    <span class="fa-stack fa-1x">
        <span class="fa fa-bookmark fa-stack-2x text-secondary"></span>
        <span class="fa fa-stack-1x text-white small">2</span>
    </span>
</div>
@elseif ($loop->iteration === 3)
<div class="card-img-overlay-ranking">
    <span class="fa-stack fa-1x">
        <span class="fa fa-bookmark fa-stack-2x text-mocha"></span>
        <span class="fa fa-stack-1x text-white small">3</span>
    </span>
</div>
@elseif ($loop->iteration >= 4)
<div class="card-img-overlay-ranking">
    <span class="fa-stack fa-1x">
        <span class="fa fa-bookmark fa-stack-2x text-latte"></span>
        <span class="fa fa-stack-1x text-white small">{{ $loop->iteration }}</span>
    </span>
</div>
@endif
