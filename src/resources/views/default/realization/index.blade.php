@extends('default.layout')
@section('content')

    <ul>
        @foreach($items as $item)
            <li>
                {{$item->title}}
            </li>
        @endforeach
    </ul>

@endsection
