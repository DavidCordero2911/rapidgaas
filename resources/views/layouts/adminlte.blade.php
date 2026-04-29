@extends('adminlte::page')

@section('title', 'RapidGaas')

@section('content_header')
    <h1>@yield('page_title')</h1>
@stop

@section('content')
    @yield('page_content')
@stop

@section('css')
    @yield('extra_css')
@stop

@section('js')
    @yield('extra_js')
@stop
