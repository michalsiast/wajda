<h2>article category home</h2>

<ul>
    @foreach($items as $item)
        <li>
            <a href="{{route('article_category.show.'.$item->id)}}">{{$item->title}}</a>
        </li>
    @endforeach
</ul>
