@extends('default.layout')
@section('content')
    @include('default.subheader', ['pageName' => $page->name])

    <div class="gallery" style="padding: 120px 0px;">
        <div class="container">
            <div class="row">
                @foreach($items as $item)
                    <div class="col-lg-4" style="margin-bottom: 15px;">
                        <a href="{{route('realization_category.show.'.$item->id)}}">
                            <img style="width: 100%; height: 400px; object-fit: cover" src="{{ renderImage($item->galleryCover(), 600, 600, 'cover') }}" alt="">
                            <h4 style="text-align: center;margin-top: 10px;">{{$item->title}}</h4>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
