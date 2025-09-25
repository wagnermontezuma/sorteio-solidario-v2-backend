@extends('layouts.default')

@section('title', 'Sorteios')

@section('content')
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Sorteios</li>
    </ol>

    <h1 class="page-header mb-3">Gerenciar Sorteios</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3">
        <a href="{{ route('admin.sorteios.create') }}" class="btn btn-primary">
            <i class="fa fa-plus mr-1"></i> Criar novo sorteio
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Prêmio</th>
                            <th>Status</th>
                            <th>Data do sorteio</th>
                            <th>Criado em</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sorteios as $sorteio)
                            <tr>
                                <td>{{ $sorteio->name }}</td>
                                <td>{{ $sorteio->prize }}</td>
                                <td>
                                    <span class="badge badge-secondary text-uppercase">{{ $sorteio->status }}</span>
                                </td>
                                <td>{{ optional($sorteio->draw_date)->format('d/m/Y H:i') ?? '—' }}</td>
                                <td>{{ $sorteio->created_at?->format('d/m/Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Nenhum sorteio cadastrado até o momento.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $sorteios->links() }}
        </div>
    </div>
@endsection

