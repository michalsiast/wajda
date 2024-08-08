<h2>article home</h2>
@foreach($items as $item)
    <li>
        <a href="{{route('article.show.'.$item->id)}}">{{$item->title}}</a>
    </li>
@endforeach
