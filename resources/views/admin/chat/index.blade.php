@extends('layouts.adminlte')
@section('page_title', 'Chat con clientes')
@section('extra_css')
<style>
    :root { --naranja: #FF6600; --azul: #007FFF; }
    .welcome-banner { background:linear-gradient(135deg,#1a1a2e 0%,#16213e 50%,#0f3460 100%); border-radius:12px; border-left:5px solid var(--naranja); color:white; padding:20px 25px; margin-bottom:25px; }
    .section-title { font-weight:700; color:#2d2d2d; border-left:4px solid var(--naranja); padding-left:10px; margin-bottom:20px; }
    .conv-card { border:none; border-radius:12px; box-shadow:0 4px 15px rgba(0,0,0,0.08); margin-bottom:15px; transition:transform 0.2s; cursor:pointer; text-decoration:none; color:inherit; display:block; }
    .conv-card:hover { transform:translateY(-2px); color:inherit; }
    .conv-header { background:linear-gradient(135deg,#1a1a2e,#0f3460); border-radius:12px 12px 0 0; padding:15px 20px; color:white; display:flex; justify-content:space-between; align-items:center; }
    .badge-noLeidos { background:var(--naranja); color:white; border-radius:20px; padding:3px 10px; font-size:0.75rem; font-weight:700; }
    .ultimo-mensaje { padding:15px 20px; font-size:0.88rem; color:#555; border-radius:0 0 12px 12px; background:white; }
</style>
@stop
@section('page_content')
<div class="welcome-banner">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h5 class="fw-bold mb-1"><i class="fas fa-comments me-2" style="color:#FF6600;"></i>Chat con clientes</h5>
            <p class="mb-0" style="opacity:0.75; font-size:0.9rem;">Gestiona las conversaciones de los clientes.</p>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-3">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<h5 class="section-title">Conversaciones ({{ count($conversaciones) }})</h5>

@forelse($conversaciones as $conv)
    <a href="{{ route('admin.chat.show', $conv['user']->id) }}" class="conv-card">
        <div class="conv-header">
            <div class="d-flex align-items-center gap-2">
                <i class="fas fa-user-circle fa-lg"></i>
                <div>
                    <div class="fw-bold">{{ $conv['cliente']?->nombre ?? $conv['user']->nombre }}</div>
                    <div style="font-size:0.75rem; opacity:0.7;">{{ $conv['user']->email }}</div>
                </div>
            </div>
            @if($conv['noLeidos'] > 0)
                <span class="badge-noLeidos">{{ $conv['noLeidos'] }} nuevo{{ $conv['noLeidos'] > 1 ? 's' : '' }}</span>
            @endif
        </div>
        <div class="ultimo-mensaje">
            <i class="fas fa-comment-dots me-1 text-muted"></i>
            {{ Str::limit($conv['ultimo']->contenido, 80) }}
            <span class="text-muted float-end small">{{ $conv['ultimo']->created_at->format('d/m/Y H:i') }}</span>
        </div>
    </a>
@empty
    <div class="card p-5 text-center text-muted" style="border-radius:12px;">
        <i class="fas fa-comments fa-2x mb-2"></i>
        <p class="mb-0">No hay conversaciones todavía.</p>
    </div>
@endforelse
@stop
