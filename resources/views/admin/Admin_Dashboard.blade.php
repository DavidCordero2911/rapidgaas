@extends('layouts.adminlte')

@section('page_title', 'Panel Admin Taller')

@section('page_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Bienvenido, {{ auth()->user()->nombre }}</h3>
                </div>
                <div class="card-body">
                    <p>Panel de gestión del taller.</p>
                </div>
            </div>
        </div>
    </div>
@stop
