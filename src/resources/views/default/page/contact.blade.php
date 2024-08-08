@extends('default.layout')
@section('content')
    @include('default.subheader', ['pageName' => $page->name])
    @include('default.form.contact_form')
@endsection
