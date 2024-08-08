@extends('admin.layout')
@section('content')

    <main>

        <div class="card">
            <div class="card-header">
                {{__('admin.page.plural')}}
                <a href="{{route('admin.page.create')}}" class="btn btn-primary">{{__('admin.crud.create')}}</a>
            </div>
            <div class="card-body">
                <table class="table table-striped table-responsive-sm sortable" data-table="page">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>{{__('admin.page.name')}}</td>
                            <td>{{__('admin.page.type')}}</td>
                            <td>{{__('admin.active')}}</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                    @if(!$items->isEmpty())
                        @php($i = 1)
                        @foreach($items as $key=>$page)
                            <tr data-id="{{$page->id}}">
                                <td data-position>{{$i++}}</td>
                                <td>
                                    {{$page->name}}
                                    <small style="display: block">
                                        <a @if($page->active) target="_blank" @else style="color: grey; opacity: .75" @endif href="@if($page->active){{url()->to('')}}{{$page->seo->url}}@else#@endif">
                                            {{str_replace(['https://', 'http://'], '', url()->to(''))}}{{$page->seo->url}}
                                        </a>
                                    </small>

                                </td>
                                <td>{{__('admin.page.type.'.$page->type)}}</td>
                                <td>
                                    <input type="checkbox" class="status-switch" data-source_table="page" data-source_id="{{$page->id}}" {{$page->active ? 'checked' : ''}}>
                                </td>
                                <td class="text-right text-nowrap">
                                    <a href="{{route('admin.page.show', $page)}}" class="btn btn-info btn-sm"><i data-feather="edit-2" class="mr-2"></i>{{__('admin.crud.edit')}}</a>
                                    <a href="{{route('admin.page.delete', $page)}}" class="btn btn-danger btn-sm"><i data-feather="trash" class="mr-2"></i>{{__('admin.crud.delete')}}</a>
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
