@extends('layouts.default')

@section('title', 'Criar sorteio')

@section('content')
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.sorteios.index') }}">Sorteios</a></li>
        <li class="breadcrumb-item active">Criar</li>
    </ol>

    <h1 class="page-header mb-3">Novo sorteio</h1>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.sorteios.store') }}">
                @csrf

                <div class="form-group">
                    <label for="titulo">Título</label>
                    <input type="text" id="titulo" name="titulo" class="form-control @error('titulo') is-invalid @enderror" value="{{ old('titulo') }}" required>
                    @error('titulo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="premio">Prêmio</label>
                    <input type="text" id="premio" name="premio" class="form-control @error('premio') is-invalid @enderror" value="{{ old('premio') }}" required>
                    @error('premio')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <textarea id="descricao" name="descricao" class="form-control @error('descricao') is-invalid @enderror" rows="5" required>{{ old('descricao') }}</textarea>
                    @error('descricao')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="regras">Regras</label>
                    <textarea id="regras" name="regras" class="form-control @error('regras') is-invalid @enderror" rows="4">{{ old('regras') }}</textarea>
                    @error('regras')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="valor_bilhete">Valor do bilhete</label>
                        <input type="number" step="0.01" id="valor_bilhete" name="valor_bilhete" class="form-control @error('valor_bilhete') is-invalid @enderror" value="{{ old('valor_bilhete') }}" required>
                        @error('valor_bilhete')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="total_bilhetes">Total de bilhetes</label>
                        <input type="number" id="total_bilhetes" name="total_bilhetes" class="form-control @error('total_bilhetes') is-invalid @enderror" value="{{ old('total_bilhetes') }}" required>
                        @error('total_bilhetes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="data_sorteio">Data do sorteio</label>
                        <input type="datetime-local" id="data_sorteio" name="data_sorteio" class="form-control @error('data_sorteio') is-invalid @enderror" value="{{ old('data_sorteio') }}">
                        @error('data_sorteio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status" class="form-control @error('status') is-invalid @enderror" required>
                        <option value="">Selecione</option>
                        <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Ativo</option>
                        <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>Concluído</option>
                        <option value="cancelled" {{ old('status') === 'cancelled' ? 'selected' : '' }}>Cancelado</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="imagem_url">URL da imagem principal</label>
                    <input type="url" id="imagem_url" name="imagem_url" class="form-control @error('imagem_url') is-invalid @enderror" value="{{ old('imagem_url') }}" required>
                    @error('imagem_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.sorteios.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Salvar sorteio</button>
                </div>
            </form>
        </div>
    </div>
@endsection

