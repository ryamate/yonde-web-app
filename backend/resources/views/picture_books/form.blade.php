@csrf
<section>
    <div>
        <label for="read_status">読書状況</label>
    </div>
    <div class="form-group">
        <div class="btn-group btn-group-toggle btn-block" data-toggle="buttons">
            <label
                class="btn btn-sm btn-outline-dark {{ (empty(old('read_status'))||(old('read_status') === '0')) ? 'active' : '' }}">
                <input type="radio" name="read_status" id="read_status0" autocomplete="off" value="0"
                    {{ (empty(old('read_status'))||(old('read_status') === '0')) ? 'checked' : '' }}>未設定
            </label>
            <label class="btn btn-sm btn-outline-dark">
                <input type="radio" name="read_status" id="read_status1" autocomplete="off" value="1"
                    {{ (empty(old('read_status'))||(old('read_status') === '1')) ? 'checked' : '' }}>よみたい
            </label>
            <label class="btn btn-sm btn-outline-dark">
                <input type="radio" name="read_status" id="read_status2" autocomplete="off" value="2"
                    {{ (empty(old('read_status'))||(old('read_status') === '2')) ? 'checked' : '' }}>よんだ
            </label>
            <label class="btn btn-sm btn-outline-dark">
                <input type="radio" name="read_status" id="read_status3" autocomplete="off" value="3"
                    {{ (empty(old('read_status'))||(old('read_status') === '3')) ? 'checked' : '' }}>なんども
            </label>
        </div>
    </div>
    <div class="form-group">
        <label for="five_star_rating">評価(5点満点)</label>
        <select name="five_star_rating" id="five_star_rating" class="form-control">
            <option value="0" {{ (old('five_star_rating') === '0') ? 'selected' : '' }}>まだ評価しない</option>
            <option value="1" {{ (old('five_star_rating') === '1') ? 'selected' : '' }}>★☆☆☆☆</option>
            <option value="2" {{ (old('five_star_rating') === '2') ? 'selected' : '' }}>★★☆☆☆</option>
            <option value="3" {{ (old('five_star_rating') === '3') ? 'selected' : '' }}>★★★☆☆</option>
            <option value="4" {{ (old('five_star_rating') === '4') ? 'selected' : '' }}>★★★★☆</option>
            <option value="5" {{ (old('five_star_rating') === '5') ? 'selected' : '' }}>★★★★★</option>
        </select>
    </div>
    <div class="form-group">
        <label for="summary">レビュー・感想</label>
        <textarea type="text" name="summary" id="summary" rows="5" class="form-control"
            value="{{ old('summary') }}"></textarea>
    </div>

    <input type="hidden" name="google_books_id" value="{{ $picture_book['google_books_id'] }}" />
    <input type="hidden" name="isbn_13" value="{{ $picture_book['isbn_13'] }}" />
    <input type="hidden" name="title" value="{{ $picture_book['title'] }}" />
    <input type="hidden" name="authors" value="{{ $picture_book['authors'] }}" />
    <input type="hidden" name="published_date" value="{{ $picture_book['published_date'] }}" />
    <input type="hidden" name="thumbnail_uri" value="{{ $picture_book['thumbnail_uri'] }}" />
</section>
