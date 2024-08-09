@extends('default.layout')
@section('content')
{{--{!! getPhoneLink('phone', 'phone', '<b>icon</b> ') !!}--}}
{{--{!! getEmailLink('email', 'email',  '<b>icon</b> ') !!}--}}
{{--    <span style="display: block">{!! getAddressString() !!}</span>--}}
{{--    <span style="display: block">{!! getFooterCreator() !!}</span>--}}

    @include('default.rotator.base', ['id_rotator' => $fields->rotator, 'type' => 'main'])
<section class="about-us-area-one">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-6">
                <div class="about-image position-relative">
                    <div class="image">
                        <img src="{{asset('images/about_us.jpg')}}" alt="about-us">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-6">
                <div class="about-info ms-4">
                    <div class="section-title-one">
                        @if (!empty($fields->sub_title_about_us))
                            <span class="sub-title uppercase">{{$fields->sub_title_about_us}}</span>
                        @endif

                        @if (!empty($fields->title_about_us))
                            <h2 class="title">{{$fields->title_about_us}}</h2>
                        @endif
                    </div>

                    @if (!empty($fields->description_about_us))
                        <p>{!! $fields->description_about_us !!}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<section class="service-details-area">
    <div class="container">
        <div style="display: flex; flex-direction: column; align-items: center">
            <div class="section-title-one" style="margin-bottom: 10px;">
                @if(!empty($fields->title_why_us))
                    <h2 class="title" style="text-align: center">{{$fields->title_why_us}}</h2>
                @endif
            </div>
            @if(!empty($fields->description_why_us))
                {!! $fields->description_why_us !!}
            @endif
        </div>
        <div class="service-details-content">
            @include('default.article.home')
        </div>
    </div>
</section>

<section class="services-area-one">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="section-title-one">
                    @if(!empty($fields->header_offer))
                        <span class="sub-title uppercase no-after dark wow fadeInLeft" data-wow-delay=".2s">
                            {{$fields->header_offer}}
                        </span>
                    @endif
                    @if(!empty($fields->title_offer))
                        <h2 class="title wow fadeInLeft" data-wow-delay=".4s">
                            {{$fields->title_offer}}
                        </h2>
                    @endif
                </div>
            </div>
            <div class="col-lg-6 ms-auto align-self-center">
                <div class="service-summery wow fadeInRight" data-wow-delay=".2s">
                    @if(!empty($fields->description_offer))
                        <p>{!! $fields->description_offer !!}</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            @include('default.offer.home')
        </div>
    </div>
</section>

<section class="working-process-area-one">
    <div class="container">
        <div class="row">
            <div class="col-lg-6" style="display: flex;flex-direction: column;justify-content: center;">
                <div class="section-title-one">
                    @if (!empty($fields->header_specialization))
                        <h2 class="title">{{$fields->header_specialization}}</h2>
                    @endif
                </div>
                <div class="working-process-info">
                    @if (!empty($fields->description_specialization))
                        {!! $fields->description_specialization !!}
                    @endif
                    <a href="{{route('offer.index')}}" class="common-btn uppercase">Zobacz ofertę <i
                                class="fas fa-plus"></i></a>
                </div>
            </div>
            <div class="col-lg-5 ms-auto working-process-item-container">
                @include('default.offer.category.home')
            </div>
        </div>
    </div>
</section>

<section class="messages-area-one" style="margin-bottom: 70px;">
    <div class="messages-area-one-bg">
        <div class="container">
            <div class="messages-area-one-main">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="image pe-3">
{{--                            <img style="height: 560px; object-fit: cover" src="{{asset('images/contact.jpg')}}" alt="messages-image"--}}
{{--                                 class="img-fluid w-100">--}}
                            <video width="640" height="750" controls>
                                <source src="{{asset('images/film_1.mp4')}}" type="video/mp4">
                            </video>
                        </div>
                    </div>
                    <div class="col-lg-6 align-self-center">
                        <div class="text">
                            <div class="section-title-one" style="margin-bottom: 0px;">
                                @if(!empty($fields->subtitle_contact))
                                    <span class="sub-title uppercase white">
                                        {{$fields->subtitle_contact}}
                                    </span>
                                @endif
                                @if(!empty($fields->title_contact))
                                    <h2 class="title white">
                                        {{$fields->title_contact}}
                                    </h2>
                                @endif
                                @if(!empty($fields->description_contact))
                                    {!! $fields->description_contact !!}
                                @endif
                                    <a href="about-us.html" class="common-btn uppercase wow contact-button" >Napisz do nas <i class="fas fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
