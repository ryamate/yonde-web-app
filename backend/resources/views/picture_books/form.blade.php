@csrf
<section>
    <div>
        <label for="read_status">読書状況</label>
    </div>
    <div class="form-group">
        <div class="btn-group btn-group-toggle btn-block" data-toggle="buttons">
            <label
                class="btn btn-sm btn-outline-secondary {{ ((($pictureBook->read_status ?? old('read_status')) ?? 0 ) == 0) ? 'active' : '' }}">
                <input type="radio" name="read_status" id="read_status0" autocomplete="off" value="0"
                    {{ ((($pictureBook->read_status ?? old('read_status')) ?? 0 ) == 0) ? 'checked' : '' }}>
                きになる
            </label>
            <label
                class="btn btn-sm btn-outline-teal1 {{ (($pictureBook->read_status ?? old('read_status')) == 1) ? 'active' : '' }}">
                <input type="radio" name="read_status" id="read_status1" autocomplete="off" value="1"
                    {{ (($pictureBook->read_status ?? old('read_status')) == 1) ? 'checked' : '' }}>
                よんだ
            </label>
        </div>
    </div>

    <div class="form-group">
        <label for="five_star_rating">評価(5点満点)</label>
        <select name="five_star_rating" id="five_star_rating" class="form-control">
            <option value="0" {{ ($pictureBook->five_star_rating ?? old('five_star_rating') == 0) ? 'selected' : '' }}>
                まだ評価しない
            </option>
            <option value="1" {{ ($pictureBook->five_star_rating ?? old('five_star_rating') == 1) ? 'selected' : '' }}>
                ★☆☆☆☆
            </option>
            <option value="2" {{ ($pictureBook->five_star_rating ?? old('five_star_rating') == 2) ? 'selected' : '' }}>
                ★★☆☆☆
            </option>
            <option value="3" {{ ($pictureBook->five_star_rating ?? old('five_star_rating') == 3) ? 'selected' : '' }}>
                ★★★☆☆
            </option>
            <option value="4" {{ ($pictureBook->five_star_rating ?? old('five_star_rating') == 4) ? 'selected' : '' }}>
                ★★★★☆
            </option>
            <option value="5" {{ ($pictureBook->five_star_rating ?? old('five_star_rating') == 5) ? 'selected' : '' }}>
                ★★★★★
            </option>
        </select>
    </div>

    <div class="form-group">
        <label for="review">レビュー・感想</label>
        <textarea type="text" name="review" id="review" rows="5"
            class="form-control">{{ $pictureBook->review ?? old('review') }}</textarea>
        <ul class="text-dark small">
            <li>1000文字以内</li>
        </ul>
    </div>
</section>
