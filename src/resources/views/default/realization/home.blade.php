<h2>realization home</h2>
@foreach($items as $item)
    <li>
        <a href="{{route('realization.show.'.$item->id)}}">{{$item->title}}</a>
    </li>
@endforeach
