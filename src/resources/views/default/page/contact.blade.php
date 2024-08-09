@extends('default.layout')
@section('content')
    @include('default.subheader', ['pageName' => $page->name])
    <section class="contact-form-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-title-one">
                        @if (!empty($fields->header_contact))
                            <span class="sub-title uppercase">{{$fields->header_contact}}</span>
                        @endif

                        @if (!empty($fields->title_contact))
                            <h2 class="title">{{$fields->title_contact}}</h2>
                        @endif
                    </div>

                    @if (!empty($fields->description_contact))
                        <div class="short-description">
                            {!! $fields->description_contact !!}
                        </div>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="contact-form">
                        @include('default.form.contact_form')
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-information">

                        @if(getConstField('phone'))
                            <div class="contact-info-item">
                                <ul class="list-unstyled">
                                    <li class="icon">
                                        <i class="fas fa-phone-alt"></i>
                                    </li>
                                    <li class="info">
                                        <h4 class="title">Telefon</h4>
                                        <p><a href="tel:{{ str_replace(' ', '', getConstField('phone')) }}" style="color: #616670">{{ getConstField('phone') }}</a></p>
                                    </li>
                                </ul>
                            </div>
                        @endif

                        @if(getConstField('email'))
                            <div class="contact-info-item">
                                <ul class="list-unstyled">
                                    <li class="icon">
                                        <i class="fas fa-envelope"></i>
                                    </li>
                                    <li class="info">
                                        <h4 class="title">E-mail</h4>
                                        <p><a href="mailto:{{ getConstField('email') }}" style="color: #616670">{{ getConstField('email') }}</a></p>
                                    </li>
                                </ul>
                            </div>
                        @endif

                        @if(getConstField('company_address') || getConstField('company_post_code') || getConstField('company_city'))
                            <div class="contact-info-item">
                                <ul class="list-unstyled">
                                    <li class="icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </li>
                                    <li class="info">
                                        <h4 class="title">Lokalizacja</h4>
                                        <p>
                                            <a href="{{getConstField('google_map')}}" style="color: #616670">{{ getConstField('company_address') }}<br>
                                                {{ getConstField('company_post_code') }} {{ getConstField('company_city') }}</a>
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact form end -->

    <!-- contact map start -->
    @if(getConstField('google_map_iframe'))
        <div class="contact-map-area">
            <div class="contact-map">
                <iframe src="{{ getConstField('google_map_iframe') }}" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    @endif
    <!-- contact map end -->
@endsection
