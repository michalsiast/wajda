<ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll">
    @if($items->count() > 0)
        @foreach($items as $item)
            @php
                $isActive = false;
                $url = null;
                $target = '_self';
                if($item->page) {
                    $url = route($item->page->type);
                } else {
                    $url = url()->to($item->url);
                }
                if($item->target) {
                    $target = $item->target;
                }
                $isActive = request()->fullUrlIs($url);
            @endphp
            <li class="nav-item {{ $isActive ? 'active' : '' }}">
                <a class="nav-link" href="{{$url}}" target="{{$target}}">
                    {{$item->label}}
                    @if($item->navItems->count() > 0)
                        <i class="fas fa-chevron-down"></i>
                    @endif
                </a>
                @if($item->navItems->count() > 0)
                    <ul class="list-unstyled sub-menu">
                        @foreach($item->navItems as $subItem)
                            @php
                                $isActive = false;
                                $url = null;
                                $target = '_self';
                                if($subItem->page) {
                                    $url = route($subItem->page->type);
                                } else {
                                    $url = url()->to($subItem->url);
                                }
                                if($subItem->target) {
                                    $target = $subItem->target;
                                }
                                $isActive = request()->fullUrlIs($url);
                            @endphp
                            <li class="{{ $isActive ? 'active' : '' }}">
                                <a href="{{$url}}" target="{{$target}}">
                                    {{ $subItem->label }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    @endif
</ul>
