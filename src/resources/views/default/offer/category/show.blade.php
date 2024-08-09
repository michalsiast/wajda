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
    <section class="all-services-area">
        <div class="container">
            <div class="row">
                @foreach($items as $item)
                    <div class="col-md-6 col-lg-4">
                        <div class="all-services-item">
                            <div class="image">
                                <a href="{{route('offer.show.'.$item->id)}}" class="d-block w-100">
                                    <img style="height: 318px; object-fit: cover" src="{{ renderImage($item->galleryCover(), 350, 318, 'cover') }}" alt="all-service-image-1"
                                         class="img-fluid w-100">
                                </a>
                            </div>
                            <div class="text">
                                <h4 class="title">
                                    <a href="{{route('offer.show.'.$item->id)}}">{{$item->title}}</a>
                                </h4>
                                {!! $item->lead !!}
                                <a href="{{route('offer.show.'.$item->id)}}" class="read-more uppercase">Zobacz ofertę <i
                                        class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
