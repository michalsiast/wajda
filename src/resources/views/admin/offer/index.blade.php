@extends('admin.layout')
@section('content')

    <main>

        <div class="card">
            <div class="card-header">
                {{__('admin.offer.plural')}}
                <a href="{{route('admin.offer.create')}}" class="btn btn-primary">{{__('admin.crud.create')}}</a>
            </div>
            <div class="card-header">
                @if(isset($categories))
                    <form action="{{route('admin.offer.index')}}" method="get" id="searchCategory" class="searchCategory">
                        <label for="Filtrowanie">Filter kategorii:</label>

                        <select name="category" id="category">
                            <option value="0">Wszystkie</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" @if(isset($_GET['category'])){{$_GET['category'] == $category->id ? 'selected="selected"' : ''}}@endif>{{$category->title}}</option>
                            @endforeach
                        </select>
                    </form>
                @endif
            </div>
            <div class="card-body">
                <table class="table table-striped table-responsive-sm sortable" data-table="offer">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td></td>
                            <td>{{__('admin.offer.title')}}</td>
                            <td>Kategoria</td>
                            <td>{{__('admin.active')}}</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                    @if(!$items->isEmpty())
                        @php($i = 1)
                        @foreach($items as $key=>$offer)
                            <tr data-id="{{$offer->id}}">
                                <td data-position>{{$i++}}</td>
                                <td style="width: 50px">
                                    <img src="{{renderSmallCover($offer)}}" alt="">
                                </td>
                                <td>
                                    {{$offer->title}}
                                    @if(isset($offer->seo))
                                        <small style="display: block">
                                            <a @if($offer->active) target="_blank" @else style="color: grey; opacity: .75" @endif href="@if($offer->active){{url()->to('')}}{{$offer->seo->url}}@else#@endif">
                                                {{str_replace(['https://', 'http://'], '', url()->to(''))}}{{$offer->seo->url}}
                                            </a>
                                        </small>
                                    @endif
                                </td>
                                <td>{!! $offer->category->title ?? '' !!}</td>
                                <td>
                                    <input type="checkbox" class="status-switch" data-source_table="offer" data-source_id="{{$offer->id}}" {{$offer->active ? 'checked' : ''}}>
                                </td>
                                <td class="text-right text-nowrap">
                                    <a href="{{route('admin.offer.show', $offer)}}" class="btn btn-info btn-sm"><i data-feather="edit-2" class="mr-2"></i>{{__('admin.crud.edit')}}</a>
                                    <a href="{{route('admin.offer.delete', $offer)}}" class="btn btn-danger btn-sm"><i data-feather="trash" class="mr-2"></i>{{__('admin.crud.delete')}}</a>
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
