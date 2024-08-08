@extends('admin.layout')
@section('content')

    <main>

        <form id="user" method="POST" action="{{route('admin.user.edit')}}">
            @csrf

            <div class="card">
                <div class="card-header">
                    {{--                            <a href="{{route('admin.user.index')}}" class="btn btn-secondary">{{__('admin.crud.back')}}</a>--}}
                    <button type="submit" form="user" class="btn btn-primary">{{__('admin.crud.save')}}</button>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            {!! $form->renderFieldGroup('name') !!}
                            {!! $form->renderFieldGroup('email') !!}
                            {!! $form->renderFieldGroup('password') !!}
                            {!! $form->renderFieldGroup('password_repeat') !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
{{--                        <div class="card-header"></div>--}}
                        <div class="card-body">


                            {!! $form->renderFieldGroup('theme') !!}
                            {!! $form->renderFieldGroup('lang') !!}


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
