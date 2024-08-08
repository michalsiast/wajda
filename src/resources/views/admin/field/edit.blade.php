<div class="card">
    <div class="card-header">{{__('admin.field.plural')}}</div>
    <div class="card-body">
        @foreach($fields as $field)
            <div class="form-group">
                <label for="field_{{$field['name']}}">{{$field['label']}} <small>(${{$field['name']}})</small></label>

                @if($field->type == 'head')
                    <input id="field_{{$field['name']}}"
                           name="field[{{$field['name']}}]"
                           type="text"
                           value="{{$field['value']}}"
                           class="form-control"
                    >
                @elseif($field->type == 'text')
                    <textarea id="field_{{$field['name']}}"
                           name="field[{{$field['name']}}]"
                           type="text"
                           class="form-control ckeditorStandard"
                    >{{$field['value']}}</textarea>
                @elseif($field->type === 'rotator')
                    <select name="field[{{$field['name']}}]" id="field_{{$field['name']}}" class="form-control">
                        <option value="0">Wybierz</option>
                        @foreach($rotators as $rotator)
                            <option value="{{$rotator->id}}" {{$field['value'] == $rotator->id ? 'selected="selected"' : ""}}>{{$rotator->title}}</option>
                        @endforeach
                    </select>
                @else
                    <p>
                        ERROR - make input for '{{$field->type}} type!
                    </p>
                @endif
            </div>

        @endforeach
    </div>
</div>
