@if($items->count() > 0)
    @include('default.nav_item.main_items', ['items' => $items])
@endif
