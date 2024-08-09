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
    <section class="project-details-area">
        <div class="container">
            <div class="project-details-thumb-image">
                <img src="{{ renderImage($item->galleryCover(), 1290, 600, 'cover') }}" alt="project-details-image"
                     class="img-fluid w-100">
            </div>
            <div class="project-details-information">
                <h2 class="project-details-title">{{$item->title}}</h2>
                @if(!empty($item->text))
                    {!! preg_replace(
                        '/<ul>(.*?)<\/ul>/s',
                        '<div class="project-list-info" style="margin: 20px 0px;"><ul class="list-unstyled">$1</ul></div>',
                        preg_replace(
                            '/<li>(.*?)<\/li>/s',
                            '<li><i class="fas fa-check"></i><h6>$1</h6></li>',
                            $item->text
                        )
                    ) !!}
                @endif
            </div>
        </div>
    </section>
@endsection
