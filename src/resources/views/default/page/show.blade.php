@extends('default.layout')
@section('content')


    <h1>Page module</h1>
    {{$page}}


    <h4>field test</h4>
    <div>{!! $fields->text1 ?? '- none -' !!}</div>

    @foreach($gallery->items as $galleryItem)
        <img src="{{renderImage($galleryItem->url, 400, 200, 'resize')}}" alt="{{$galleryItem->name ?? ''}}">
    @endforeach

@endsection
