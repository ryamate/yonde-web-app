@csrf
<section>
    <div class="form-group">
        <label for="name">お子さまのお名前</label>
        <input autofocus class="form-control" type="text" id="name" value="{{ $child->name ?? old('name') }}"
            name="name" required />
        <ul class="text-dark small">
            <li>半角・全角スペース、半角スラッシュ(/)は使用できません</li>
        </ul>
    </div>

    <div class="form-group">
        <label for="gender_code">性別</label>
        <div class="btn-group btn-group-toggle btn-block" data-toggle="buttons">
            <label
                class="btn btn-sm btn-outline-secondary {{ ((($child->gender_code ?? old('gender_code')) ?? 0 ) == 0) ? 'active' : '' }}">
                <input type="radio" name="gender_code" id="gender_code0" autocomplete="off" value="0"
                    {{ ((($child->gender_code ?? old('gender_code')) ?? 0 ) == 0) ? 'checked' : '' }}>
                指定なし
            </label>
            <label
                class="btn btn-sm btn-outline-mocha {{ (($child->gender_code ?? old('gender_code')) == 1) ? 'active' : '' }}">
                <input type="radio" name="gender_code" id="gender_code1" autocomplete="off" value="1"
                    {{ (($child->gender_code ?? old('gender_code')) == 1) ? 'checked' : '' }}>
                男の子
            </label>
            <label
                class="btn btn-sm btn-outline-latte {{ (($child->gender_code ?? old('gender_code')) == 2) ? 'active' : '' }}">
                <input type="radio" name="gender_code" id="gender_code2" autocomplete="off" value="2"
                    {{ (($child->gender_code ?? old('gender_code')) == 2) ? 'checked' : '' }}>
                女の子
            </label>
        </div>
    </div>

    <div class="form-group">
        <label for="birthday">お誕生日</label>
        <input autofocus class="form-control" type="date" id="birthday"
            value="{{ $child->birthday ?? old('birthday') }}" name="birthday" required />
    </div>
</section>
