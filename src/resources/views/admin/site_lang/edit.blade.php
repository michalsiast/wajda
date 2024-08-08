@extends('admin.layout')
@section('content')

    <main>

        <form id="site_lang" method="POST" action="{{route('admin.site_lang.edit', $item)}}">
            @csrf

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{route('admin.site_lang.index')}}" class="btn btn-secondary">{{__('admin.crud.back')}}</a>
                            <button type="submit" form="site_lang" class="btn btn-primary">{{__('admin.crud.'.($item->id ? 'save' : 'add'))}}</button>
                        </div>
                        <div class="card-body">


                            {!! $form->renderFieldGroup('name') !!}
                            {!! $form->renderFieldGroup('full_name') !!}

                            <div class="row">
                                <div class="col-sm-6">
                                    {!! $form->renderFieldGroup('default_site') !!}
                                </div>
                                <div class="col-sm-6">
                                    {!! $form->renderFieldGroup('default_admin') !!}
                                </div>
                            </div>

                            {!! $form->renderFieldGroup('active') !!}
                        </div>
                    </div>
                </div>
            </div>

        </form>

    </main>

@endsection
