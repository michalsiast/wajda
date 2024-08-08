@extends('admin.layout')
@section('content')

    <main>

        <div class="card">
            <div class="card-header">
                {{__('admin.site_lang.plural')}}
                <a href="{{route('admin.site_lang.create')}}" class="btn btn-primary">{{__('admin.crud.create')}}</a>
            </div>
            <div class="card-body">
                <table class="table table-striped table-responsive-sm sortable" data-table="site_lang">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>{{__('admin.site_lang.name')}}</td>
                            <td>{{__('admin.site_lang.full_name')}}</td>
                            <td>{{__('admin.site_lang.default_site')}}</td>
                            <td>{{__('admin.site_lang.default_admin')}}</td>
                            <td>{{__('admin.active')}}</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                    @if(!$items->isEmpty())
                        @php($i = 1)
                        @foreach($items as $key=>$site_lang)
                            <tr data-id="{{$site_lang->getKey()}}">
                                <td data-position>{{$i++}}</td>
                                <td>{{$site_lang->name}}</td>
                                <td>{{$site_lang->full_name}}</td>
                                <td>
                                    @if($site_lang->default_site)
                                        <span class="badge badge-success">{{__('admin.active')}}</span>
                                    @else
                                        <span class="badge badge-warning">{{__('admin.not_active')}}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($site_lang->default_admin)
                                        <span class="badge badge-success">{{__('admin.active')}}</span>
                                    @else
                                        <span class="badge badge-warning">{{__('admin.not_active')}}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($site_lang->active)
                                        <span class="badge badge-success">{{__('admin.active')}}</span>
                                    @else
                                        <span class="badge badge-warning">{{__('admin.not_active')}}</span>
                                    @endif
                                </td>
                                <td class="text-right text-nowrap">
                                    <a href="{{route('admin.site_lang.show', $site_lang)}}" class="btn btn-info btn-sm"><i data-feather="edit-2" class="mr-2"></i>{{__('admin.crud.edit')}}</a>
                                    <a href="{{route('admin.site_lang.delete', $site_lang)}}" class="btn btn-danger btn-sm"><i data-feather="trash" class="mr-2"></i>{{__('admin.crud.delete')}}</a>
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

{{--                {{$items->links()}}--}}
            </div>
        </div>

    </main>

@endsection
