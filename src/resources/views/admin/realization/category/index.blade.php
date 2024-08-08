@extends('admin.layout')
@section('content')

    <main>

        <div class="card">
            <div class="card-header">
                {{__('admin.realization_category.plural')}}
                <a href="{{route('admin.realization_category.create')}}" class="btn btn-primary">{{__('admin.crud.create')}}</a>
            </div>

            <div class="card-body">
                <table class="table table-striped table-responsive-sm sortable" data-table="realization_category">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td></td>
                            <td>{{__('admin.realization_category.title')}}</td>
                            <td>{{__('admin.active')}}</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                    @if(!$items->isEmpty())
                        @php($i = 1)
                        @foreach($items as $key=>$realization_category)
                            <tr data-id="{{$realization_category->id}}">
                                <td data-position>{{$i++}}</td>
                                <td style="width: 50px">
                                    <img src="{{renderSmallCover($realization_category)}}" alt="">
                                </td>
                                <td>
                                    {{$realization_category->title}}
                                    @if(isset($realization_category->seo))
                                        <small style="display: block">
                                            <a @if($realization_category->active) target="_blank" @else style="color: grey; opacity: .75" @endif href="@if($realization_category->active){{url()->to('')}}{{$realization_category->seo->url}}@else#@endif">
                                                {{str_replace(['https://', 'http://'], '', url()->to(''))}}{{$realization_category->seo->url}}
                                            </a>
                                        </small>
                                    @endif
                                </td>
                                <td>
                                    <input type="checkbox" class="status-switch" data-source_table="realization_category" data-source_id="{{$realization_category->id}}" {{$realization_category->active ? 'checked' : ''}}>
                                </td>
                                <td class="text-right text-nowrap">
                                    <a href="{{route('admin.realization_category.show', $realization_category)}}" class="btn btn-info btn-sm"><i data-feather="edit-2" class="mr-2"></i>{{__('admin.crud.edit')}}</a>
                                    <a href="{{route('admin.realization_category.delete', $realization_category)}}" class="btn btn-danger btn-sm"><i data-feather="trash" class="mr-2"></i>{{__('admin.crud.delete')}}</a>
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
