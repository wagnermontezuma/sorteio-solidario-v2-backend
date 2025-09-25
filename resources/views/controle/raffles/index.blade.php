@extends('layouts.default')
@section('title', 'Sorteios')

@section('content')
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="{{ route('controle.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Sorteios</li>
    </ol>

    <h1 class="page-header">Sorteios</h1>

    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Gerenciamento de sorteios</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
                        <div class="mb-2">
                            <a href="{{ route('controle.raffles.create') }}" class="btn btn-primary"><i class="fa fa-plus mr-1"></i> Novo sorteio</a>
                        </div>
                        <form method="GET" action="{{ route('controle.raffles.index') }}" class="form-inline">
                            <div class="input-group">
                                <input type="text" name="search" value="{{ $filters['search'] ?? '' }}" class="form-control" placeholder="Buscar por nome ou slug">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="submit"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success small">{{ session('status') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Slug</th>
                                    <th class="text-nowrap">Preço</th>
                                    <th class="text-nowrap">Bilhetes</th>
                                    <th class="text-nowrap">Vendidos</th>
                                    <th class="text-nowrap">Status</th>
                                    <th class="text-nowrap">Data do sorteio</th>
                                    <th class="text-center" width="120">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($raffles as $raffle)
                                    <tr>
                                        <td>
                                            <div class="font-weight-bolder">{{ $raffle->name }}</div>
                                            <div class="text-muted small">Criado em {{ $raffle->created_at?->format('d/m/Y H:i') }}</div>
                                        </td>
                                        <td class="text-monospace">{{ $raffle->slug }}</td>
                                        <td>R$ {{ number_format($raffle->ticket_price, 2, ',', '.') }}</td>
                                        <td>{{ $raffle->total_tickets }}</td>
                                        <td>
                                            {{ $raffle->paid_tickets_count }}
                                            <div class="progress progress-sm mt-1 mb-0">
                                                @php
                                                    $progress = $raffle->total_tickets ? min(100, round(($raffle->paid_tickets_count / $raffle->total_tickets) * 100)) : 0;
                                                @endphp
                                                <div class="progress-bar" style="width: {{ $progress }}%;"></div>
                                            </div>
                                        </td>
                                        <td>
                                            @php
                                                $statusClasses = [
                                                    'active' => 'badge badge-success',
                                                    'completed' => 'badge badge-secondary',
                                                    'cancelled' => 'badge badge-danger',
                                                ];
                                            @endphp
                                            <span class="{{ $statusClasses[$raffle->status] ?? 'badge badge-light' }}">
                                                {{ __(ucfirst($raffle->status)) }}
                                            </span>
                                        </td>
                                        <td>{{ $raffle->draw_date ? $raffle->draw_date->format('d/m/Y H:i') : '—' }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('controle.raffles.edit', $raffle) }}" class="btn btn-sm btn-primary mr-1"><i class="fa fa-edit"></i></a>
                                            <form action="{{ route('controle.raffles.destroy', $raffle) }}" method="POST" class="d-inline" onsubmit="return confirm('Confirma excluir este sorteio?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">Nenhum sorteio cadastrado até o momento.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $raffles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
