@csrf
<section>

    <div class="form-group">
        <label>お子さま</label>
        <child-tags-input :initial-tags='@json($childNames ?? [])' :autocomplete-items='@json($allChildNames ?? [])'>
        </child-tags-input>
    </div>

    <div class="form-group">
        <label for="read_date">日付</label>
        <input autofocus class="form-control" type="date" id="read_date"
            value="{{ $readRecord->read_date ?? old('read_date') ?? Carbon\Carbon::today()->format("Y-m-d") }}"
            name="read_date" required />
    </div>

    <div class="form-group">
        <label>タグ</label>
        <read-record-tags-input :initial-tags='@json($tagNames ?? [])'>
        </read-record-tags-input>
    </div>

    <div class="form-group">
        <label for="memo">メモ</label>
        <textarea type="text" name="memo" id="memo" rows="5"
            class="form-control">{{ $readRecord->memo ?? old('memo') }}</textarea>
        <p class="text-muted small ml-1">140文字以内</p>
    </div>

</section>
