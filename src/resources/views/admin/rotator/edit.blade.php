@extends('admin.layout')
@section('content')

    <main>

        <form id="rotator" method="POST" action="{{route('admin.rotator.edit', $item)}}">
            @csrf

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <a href="{{route('admin.rotator.index')}}"
                                   class="btn btn-secondary">{{__('admin.crud.back')}}</a>
                                @if($item->id)
                                    <a href="{{route('admin.rotator.create')}}"
                                       class="btn btn-info">Utwórz nowy</a>
                                @endif
                            </div>
                            <div>
                                <button type="submit" form="rotator"
                                        class="btn btn-success">{{__('admin.crud.'.($item->id ? 'save' : 'add'))}}</button>
                                <button type="submit" form="rotator" name="saveandclose"
                                        class="btn btn-primary">{{__('admin.crud.'.($item->id ? 'save' : 'add'))}} i
                                    wyjdź
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            {!! $form->renderFieldGroup('title') !!}
                            <hr>
                            {!! $form->renderFieldGroup('active') !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <span><b>Ustawienia rotatora/slidera</b></span>
                        </div>
                        <div class="card-body">
                            {!! $form->renderFieldGroup('speed') !!}
                            {!! $form->renderFieldGroup('time') !!}
                            {!! $form->renderFieldGroup('pager') !!}
                            {!! $form->renderFieldGroup('arrows') !!}
                        </div>
                    </div>
                </div>
            </div>

        </form>


        @if($item->id)
            @include('admin.gallery.partial', ['gallery' => $item->gallery])
        @endif

        @

    </main>

@endsection
