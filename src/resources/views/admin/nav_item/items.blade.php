@foreach($items as $key=>$item)
    <div class="navItem__parent" data-id="{{$item->id}}">
        <div class="navItem__header">
            <div class="navItem__content">
                <span class="navItem__title">{{$item->label}}</span>
{{--                <div class="navItem__description">{{$item->url}} {{$item->page_id}}</div>--}}
            </div>
            <div class="navItem__active">
                @if($item->active)
                    <span class="badge badge-success">{{__('admin.active')}}</span>
                @else
                    <span class="badge badge-warning">{{__('admin.not_active')}}</span>
                @endif
            </div>
            <div class="navItem__buttons">
                <a href="{{route('admin.nav_item.create', [$navName, $item])}}" class="btn btn-primary btn-sm"><i data-feather="edit-2" class="mr-2"></i>{{__('admin.crud.create')}}</a>
                <a href="{{route('admin.nav_item.show', [$navName, $item])}}" class="btn btn-info btn-sm"><i data-feather="edit-2" class="mr-2"></i>{{__('admin.crud.edit')}}</a>
                <a href="{{route('admin.nav_item.delete', [$navName, $item])}}" class="btn btn-danger btn-sm"><i data-feather="trash" class="mr-2"></i>{{__('admin.crud.delete')}}</a>
            </div>
        </div>
        @if($item->navItems()->count() > 0)
            <div class="navItem__children -sortable" data-table="nav_item">
                @include('admin.nav_item.items', ['items' => $item->navItems()->orderByDesc('position')->get()])
            </div>
        @endif
    </div>
@endforeach
