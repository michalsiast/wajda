@extends('admin.layout')
@section('content')

    <main>

        <form id="smtp_settings" method="POST" action="{{route('admin.smtp_settings.edit')}}">
            @csrf

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">{{__('admin.smtp_settings.plural')}}</h2>
                    {{--                            <a href="{{route('admin.smtp_settings.index')}}" class="btn btn-secondary">{{__('admin.crud.back')}}</a>--}}
                    <button type="submit" form="smtp_settings" class="btn btn-primary">{{__('admin.crud.save')}}</button>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 col-xl-8">
                    <div class="card">
                        <div class="card-header">
                            {{__('admin.smtp_settings.plural')}}
                        </div>
                        <div class="card-body">
                            {!! $form->renderFieldGroup('smtp_from_name') !!}
                            {!! $form->renderFieldGroup('smtp_from_address') !!}
                            <div class="row">
                                <div class="col-sm-9">
                                    {!! $form->renderFieldGroup('smtp_host') !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! $form->renderFieldGroup('smtp_port') !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    {!! $form->renderFieldGroup('smtp_username') !!}
                                </div>
                                <div class="col-sm-6">
                                    {!! $form->renderFieldGroup('smtp_password') !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    {!! $form->renderFieldGroup('smtp_encryption') !!}
                                </div>
                            </div>



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
