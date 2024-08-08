@extends('admin.layout')
@section('content')

    <main>

        <form id="const_field" method="POST" action="{{route('admin.const_field.edit')}}">
            @csrf

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">{{__('admin.const_field.plural')}}</h2>
                    {{--                            <a href="{{route('admin.const_field.index')}}" class="btn btn-secondary">{{__('admin.crud.back')}}</a>--}}
                    <button type="submit" form="const_field" class="btn btn-primary">{{__('admin.crud.save')}}</button>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    {{__('admin.const_field.page_details')}}
                </div>
                <div class="card-body">
                    {!! $form->renderFieldGroup('page_title') !!}
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            {{__('admin.const_field.company_details')}}
                        </div>
                        <div class="card-body">
                            {!! $form->renderFieldGroup('company_name') !!}
                            <div class="row">
                                <div class="col-sm-3">
                                    {!! $form->renderFieldGroup('company_post_code') !!}
                                </div>
                                <div class="col-sm-9">
                                    {!! $form->renderFieldGroup('company_address') !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {!! $form->renderFieldGroup('company_city') !!}
                                </div>
                                <div class="col-md-6">
                                    {!! $form->renderFieldGroup('company_country') !!}
                                </div>
                            </div>
                            {!! $form->renderFieldGroup('company_nip') !!}
{{--                            {!! $form->renderFieldGroup('company_krs') !!}--}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            {{__('admin.const_field.contact_details')}}
                        </div>
                        <div class="card-body">
                            {!! $form->renderFieldGroup('phone') !!}
{{--                            {!! $form->renderFieldGroup('phone2') !!}--}}
                            {!! $form->renderFieldGroup('email') !!}
{{--                            {!! $form->renderFieldGroup('email2') !!}--}}
                            {!! $form->renderFieldGroup('contact_form_email') !!}
{{--                            {!! $form->renderFieldGroup('google_map') !!}--}}
                            {!! $form->renderFieldGroup('google_map_iframe') !!}
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            Social Media
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    {!! $form->renderFieldGroup('facebook') !!}
                                </div>
                                <div class="col-lg-6">
                                    {!! $form->renderFieldGroup('instagram') !!}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                    {!! $form->renderFieldGroup('contact_form_rule') !!}
                        </div>
                    </div>
                </div>
            </div>

        </form>


{{--        @if($item->id)--}}
{{--            @include('admin.gallery.partial', ['gallery' => $item->gallery])--}}
{{--        @endif--}}

    </main>

@endsection
