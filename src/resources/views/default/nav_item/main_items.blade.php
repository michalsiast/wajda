@if($items->count() > 0)
    <ul>
        @foreach($items as $item)
            @php
                $isActive = false;
                $url = null;
                $target = '_self';

                if($item->page) {
                    $url = route($item->page->type);
                }
                else {
                    $url = url()->to($item->url);
                }

                if($item->target) {
                    $target = $item->target;
                }

                $isActive = request()->fullUrlIs($url);
            @endphp
            <li class="{{$isActive ? '-active' : ''}}">
                <a href="{{$url}}" target="{{$target}}">{{$item->label}}</a>
            </li>
            @include('default.nav_item.main_items', ['items' => $item->navItems])
        @endforeach
    </ul>
@endif
