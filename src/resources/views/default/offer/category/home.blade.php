<h2>offer cat home</h2>
@foreach($items as $item)
    <li>
        <a href="{{route('offer_category.show.'.$item->id)}}">{{$item->title}}</a>
    </li>
@endforeach
