<h2>realization category home</h2>
@foreach($items as $item)
    <li>
        <a href="{{route('realization_category.show.'.$item->id)}}">{{$item->title}}</a>
    </li>
@endforeach
