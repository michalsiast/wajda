@extends('admin.layout')
@section('content')

    <main>

        <form id="nav_item" method="POST" action="{{route('admin.nav_item.edit', [$navName, $item])}}">
            @csrf

            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{route('admin.nav_item.index', $navName)}}" class="btn btn-secondary">{{__('admin.crud.back')}}</a>
                            <button type="submit" form="nav_item" class="btn btn-primary">{{__('admin.crud.'.($item->id ? 'save' : 'add'))}}</button>
                        </div>
                        <div class="card-body">

                            <input type="hidden" name="nav_item[nav_name]" value="{{$navName}}">

                            {!! $form->renderFieldGroup('nav_item_id') !!}
                            {!! $form->renderFieldGroup('page_id') !!}
                            {!! $form->renderFieldGroup('label') !!}
                            {!! $form->renderFieldGroup('url') !!}
                            {!! $form->renderFieldGroup('target') !!}

                            <hr>

                            {!! $form->renderFieldGroup('active') !!}


                        </div>
                    </div>
                </div>
                <div class="col-lg-4">

                </div>
            </div>

        </form>

    </main>

@endsection
