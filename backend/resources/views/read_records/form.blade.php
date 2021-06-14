@csrf
<section>

    {{-- 子どもタグ --}}

    <div class="form-group">
        <label for="read_date">よんだ日</label>
        <input autofocus class="form-control" type="date" id="read_date"
            value="{{ $readRecord->read_date ?? old('read_date') }}" name="read_date" required />
    </div>

    {{-- 感想タグ --}}
    {{-- <div class="form-group">
        <review-tags-input :initial-tags='@json($tagNames ?? [])' :autocomplete-items='@json($allTagNames ?? [])'>
        </review-tags-input>
    </div> --}}

    <div class="form-group">
        <label for="memo">メモ</label>
        <textarea type="text" name="memo" id="memo" rows="5"
            class="form-control">{{ $readRecord->memo ?? old('memo') }}</textarea>
    </div>

</section>
