@extends('admin.layout')
@section('content')

    <main>

        <form id="page" method="POST" action="{{route('admin.page.edit', $item)}}">
            @csrf

            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                    <a href="{{route('admin.page.index')}}"
                                       class="btn btn-secondary">{{__('admin.crud.back')}}</a>
                                @if($item->id)
                                <a href="{{route('admin.page.create')}}"
                                   class="btn btn-info">Utwórz nowy</a>
                                @endif

                            </div>
                            <div>
                                <button type="submit" form="page"
                                        class="btn btn-success">{{__('admin.crud.'.($item->id ? 'save' : 'add'))}}</button>
                                <button type="submit" form="page" name="saveandclose"
                                        class="btn btn-primary">{{__('admin.crud.'.($item->id ? 'save' : 'add'))}} i
                                    wyjdź
                                </button>
                            </div>
                        </div>
                        <div class="card-body">


                            {!! $form->renderFieldGroup('name') !!}
                            {!! $form->renderFieldGroup('type') !!}
                            {!! $form->renderFieldGroup('active') !!}


                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('admin.seo.partial', compact('formSeo'))
                </div>
            </div>

            @if($item->id)
                @include('admin.field.edit', ['id' => $item->id])
            @endif

        </form>


        @if($item->id)
            @include('admin.gallery.partial', ['gallery' => $item->gallery])
        @endif

    </main>

@endsection
