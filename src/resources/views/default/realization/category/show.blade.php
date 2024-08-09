@extends('default.layout')
@section('content')
    <section class="breadcrumb-area" data-background="{{asset('images/subheader.png')}}">
        <div class="container">
            <div class="breadcrumb-content">
                <div class="row">
                    <div class="col-md-6 align-self-center">
                        <div class="breadcrumb-title">
                            <h2 class="title text-white">{!! $item->title !!}</h2>
                        </div>
                    </div>
                    <div class="col-md-6 align-self-center">
                        <ul class="list-unstyled bread-crumb text-md-end">
                            <li><a href="/">Strona główna</a></li>
                            <li>{!! $item->title !!}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <div class="gallery" style="padding: 120px 0px;">
            <div class="container">
                <div class="row">
                    @foreach($items as $item)
                        @if($item->realization_category_id === 2)
                            <div>
                                <video width="640" height="500" controls>
                                    <source src="{{asset('images/film_1.mp4')}}" type="video/mp4">
                                </video>
                                <video width="640" height="500" controls>
                                    <source src="{{asset('images/film_2.mp4')}}" type="video/mp4">
                                </video>
                            </div>
                        @else
                            <div class="col-lg-4" style="margin-bottom: 15px;">
                                <a href="{{route('realization.show.'.$item->id)}}">
                                    <img style="width: 100%; height: 400px; object-fit: cover" src="{{ renderImage($item->galleryCover(), 600, 600, 'cover') }}" alt="">
                                    <h4 style="text-align: center;margin-top: 10px;">{{$item->title}}</h4>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
@endsection
