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
                @foreach($item->gallery->items as $item)
                    <div class="col-lg-4" style="margin-bottom: 15px;">
                        <a href="{{renderImage($item->url, 1920, 1080, 'resize')}}">
                            <img style="width: 100%" src="{{renderImage($item->url, 600, 600, 'fit')}}" alt="">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @push('scripts.body.bottom')
        <script>
            var lightbox = $('.gallery a').simpleLightbox({});
        </script>
    @endpush
@endsection
