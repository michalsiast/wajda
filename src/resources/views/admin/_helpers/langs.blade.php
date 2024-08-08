@if(count($items) > 0)
    <form method="POST" action="{{route('admin.change_lang')}}">
        @csrf

        <select name="admin_lang"
                class="custom-select custom-select-sm"
                style="min-width: 100px"
                onchange="this.form.submit()">
            @foreach($items as $item)
                <option value="{{$item->name}}" {{$item->name == getAdminLang() ? 'selected' : ''}}>{{$item->full_name}}</option>
            @endforeach
        </select>
{{--        @dump('locale: ', app()->getLocale())--}}
    </form>
@endif
