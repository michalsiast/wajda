@extends('admin.layout')
@section('content')

    <main>

        <div class="card">
            <div class="card-header">
                {{__('admin.nav_item.plural')}}
                <a href="{{route('admin.nav_item.create', $navName)}}" class="btn btn-primary">{{__('admin.crud.create')}}</a>
            </div>
            <div class="card-body">
                <div class="navItem -sortable" data-table="nav_item">
                    @include('admin.nav_item.items', ['items' => $items, 'navName' => $navName])
                </div>
            </div>
        </div>

    </main>

@endsection
