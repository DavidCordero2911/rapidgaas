@extends('layouts.adminlte')

@section('page_title', 'Mi Vehículo')

@section('page_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Bienvenido, {{ auth()->user()->nombre }}</h3>
                </div>
                <div class="card-body">
                    <p>Estado de tu vehículo.</p>
                </div>
            </div>
        </div>
    </div>
@stop
