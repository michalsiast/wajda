@extends('admin.layout')
@section('content')

    <main>

        <div class="card">
            <div class="card-header">
                Rotator/Slider
                <a href="{{route('admin.rotator.create')}}" class="btn btn-primary">{{__('admin.crud.create')}}</a>
            </div>
            <div class="card-body">
                <table class="table table-striped table-responsive-sm sortable" data-table="rotator">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Nazwa</td>
                            <td>Liczba slajdów</td>
                            <td>{{__('admin.active')}}</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                    @if(!$items->isEmpty())
                        @php($i = 1)
                        @foreach($items as $key=>$rotator)
                            <tr data-id="{{$rotator->id}}">
                                <td data-position>{{$i++}}</td>
                                <td>
                                    {{$rotator->title}}
                                </td>
                                <td>{{count($rotator->gallery->items)}}</td>
                                <td>
                                    <input type="checkbox" class="status-switch" data-source_table="rotator" data-source_id="{{$rotator->id}}" {{$rotator->active ? 'checked' : ''}}>
                                </td>
                                <td class="text-right text-nowrap">
                                    <a href="{{route('admin.rotator.show', $rotator)}}" class="btn btn-info btn-sm"><i data-feather="edit-2" class="mr-2"></i>{{__('admin.crud.edit')}}</a>
                                    <a href="{{route('admin.rotator.delete', $rotator)}}" class="btn btn-danger btn-sm"><i data-feather="trash" class="mr-2"></i>{{__('admin.crud.delete')}}</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="100">{{__('admin.empty_set')}}</td>
                        </tr>
                    @endif
                    </tbody>
                </table>

                {{$items->links()}}
            </div>
        </div>

    </main>

@endsection
