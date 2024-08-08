@extends('admin.layout')
@section('content')

    <main>

        <form id="google_app_settings" method="POST" action="{{route('admin.google_app_settings.edit')}}">
            @csrf

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">{{__('admin.google_app_settings.plural')}}</h2>
                    {{--                            <a href="{{route('admin.google_app_settings.index')}}" class="btn btn-secondary">{{__('admin.crud.back')}}</a>--}}
                    <button type="submit" form="google_app_settings" class="btn btn-primary">{{__('admin.crud.save')}}</button>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 col-xl-8">
                    <div class="card">
                        <div class="card-header">
                            {{__('admin.google_app_settings.plural')}}
                        </div>
                        <div class="card-body">

                            {!! $form->renderFieldGroup('google_app_recaptcha2_site_key') !!}
                            {!! $form->renderFieldGroup('google_app_recaptcha2_secret_key') !!}

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
