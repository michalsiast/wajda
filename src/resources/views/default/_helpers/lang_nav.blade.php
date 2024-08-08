@if($items->count() > 1)
    <ul>
        @foreach($items as $item)
            @php
                $url = url()->to($item->name);

                if($item->default_site) {
                    $url = url()->to('/');
                }
            @endphp
            <li>
                <a href="{{$url}}">{{$item->full_name}}</a>
            </li>
        @endforeach
    </ul>
@endif
