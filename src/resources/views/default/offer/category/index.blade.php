@extends('default.layout')
@section('content')
    @include('default.subheader', ['pageName' => 'Kategoria offert'])
    <ul>
        @foreach($items as $item)
            <li>
                {{$item->title}}
            </li>
        @endforeach
    </ul>

@endsection
