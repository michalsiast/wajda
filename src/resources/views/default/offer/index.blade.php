@extends('default.layout')
@section('content')
    @include('default.subheader', ['pageName' => $page->name])
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
