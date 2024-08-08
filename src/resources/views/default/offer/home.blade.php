<h2>offer home</h2>
@foreach($items as $item)
    <li>
        <a href="{{route('offer.show.'.$item->id)}}">{{$item->title}}</a>
    </li>
@endforeach
