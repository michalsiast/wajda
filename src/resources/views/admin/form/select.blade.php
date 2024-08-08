<div class="form-group">
    <label for="{{$model.'_'.$field['name']}}">{{__($field['label'])}}</label>

    <select id="{{$model.'_'.$field['name']}}" name="{{$model}}[{{$field['name']}}]"
            class="custom-select"
            @foreach($field['rules'] as $ruleName=>$ruleValue) {{$ruleName}}="{{$ruleValue}}" @endforeach>
        <option value="" selected>{{__('admin.select_none')}}</option>
        @foreach($field['options'] as $optionName=>$optionValue)
            <option value="{{$optionName}}" {{$field['value'] == $optionName ? 'selected="selected"' : ''}}>{{$optionValue}}</option>
        @endforeach
    </select>

    @if($errors->has($field['name']))
        <div class="invalid-feedback">
            {{$errors->first($field['name'])}}
        </div>
    @endif
</div>
