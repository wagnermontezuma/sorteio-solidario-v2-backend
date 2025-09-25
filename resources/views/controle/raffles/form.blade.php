@extends('layouts.default')
@section('title', $mode === 'edit' ? 'Editar sorteio' : 'Novo sorteio')

@section('content')
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.raffles.index') }}">Sorteios</a></li>
        <li class="breadcrumb-item active">{{ $mode === 'edit' ? 'Editar' : 'Novo' }}</li>
    </ol>

    <h1 class="page-header">{{ $mode === 'edit' ? 'Editar sorteio' : 'Cadastrar sorteio' }}</h1>

    <div class="row">
        <div class="col-xl-10">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">{{ $raffle->exists ? $raffle->name : 'Informações básicas' }}</h4>
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ $mode === 'edit' ? route('admin.raffles.update', $raffle) : route('admin.raffles.store') }}">
                        @csrf
                        @if ($mode === 'edit')
                            @method('PUT')
                        @endif

                        <div class="form-group">
                            <label for="name">Nome *</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $raffle->name) }}" class="form-control @error('name') is-invalid @enderror" required>
                            @error('name')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="slug">Slug</label>
                                <input type="text" id="slug" name="slug" value="{{ old('slug', $raffle->slug) }}" class="form-control @error('slug') is-invalid @enderror" placeholder="deixe vazio para gerar automaticamente">
                                @error('slug')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label for="ticket_price">Preço do bilhete (R$) *</label>
                                <input type="number" id="ticket_price" name="ticket_price" value="{{ old('ticket_price', $raffle->ticket_price) }}" class="form-control @error('ticket_price') is-invalid @enderror" step="0.01" min="0" required>
                                @error('ticket_price')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label for="total_tickets">Quantidade de bilhetes *</label>
                                <input type="number" id="total_tickets" name="total_tickets" value="{{ old('total_tickets', $raffle->total_tickets) }}" class="form-control @error('total_tickets') is-invalid @enderror" min="1" required>
                                @error('total_tickets')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="image_url">Imagem principal (URL)</label>
                            <input type="url" id="image_url" name="image_url" value="{{ old('image_url', $raffle->image_url) }}" class="form-control @error('image_url') is-invalid @enderror">
                            @error('image_url')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label for="gallery_images_raw">Galeria de imagens (uma URL por linha)</label>
                            <textarea id="gallery_images_raw" name="gallery_images_raw" rows="3" class="form-control">{{ old('gallery_images_raw', implode("\n", $raffle->gallery_images ?? [])) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="description">Descrição *</label>
                            <textarea id="description" name="description" rows="4" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $raffle->description) }}</textarea>
                            @error('description')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label for="rules">Regras / Regulamento</label>
                            <textarea id="rules" name="rules" rows="4" class="form-control @error('rules') is-invalid @enderror">{{ old('rules', $raffle->rules) }}</textarea>
                            @error('rules')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="draw_date">Data do sorteio</label>
                                <input type="datetime-local" id="draw_date" name="draw_date" value="{{ old('draw_date', optional($raffle->draw_date)->format('Y-m-d\TH:i')) }}" class="form-control @error('draw_date') is-invalid @enderror">
                                @error('draw_date')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="result_published_at">Resultado publicado em</label>
                                <input type="datetime-local" id="result_published_at" name="result_published_at" value="{{ old('result_published_at', optional($raffle->result_published_at)->format('Y-m-d\TH:i')) }}" class="form-control @error('result_published_at') is-invalid @enderror">
                                @error('result_published_at')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="federal_lottery_contest">Concurso da Loteria Federal</label>
                                <input type="text" id="federal_lottery_contest" name="federal_lottery_contest" value="{{ old('federal_lottery_contest', $raffle->federal_lottery_contest) }}" class="form-control @error('federal_lottery_contest') is-invalid @enderror">
                                @error('federal_lottery_contest')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="federal_lottery_result">Resultado da Loteria Federal</label>
                                <input type="text" id="federal_lottery_result" name="federal_lottery_result" value="{{ old('federal_lottery_result', $raffle->federal_lottery_result) }}" class="form-control @error('federal_lottery_result') is-invalid @enderror">
                                @error('federal_lottery_result')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="winning_ticket_number">Número vencedor</label>
                                <input type="text" id="winning_ticket_number" name="winning_ticket_number" value="{{ old('winning_ticket_number', $raffle->winning_ticket_number) }}" class="form-control @error('winning_ticket_number') is-invalid @enderror">
                                @error('winning_ticket_number')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="status">Status *</label>
                                <select id="status" name="status" class="form-control @error('status') is-invalid @enderror" required>
                                    @php($currentStatus = old('status', $raffle->status ?? 'active'))
                                    <option value="active" {{ $currentStatus === 'active' ? 'selected' : '' }}>Ativo</option>
                                    <option value="completed" {{ $currentStatus === 'completed' ? 'selected' : '' }}>Finalizado</option>
                                    <option value="cancelled" {{ $currentStatus === 'cancelled' ? 'selected' : '' }}>Cancelado</option>
                                </select>
                                @error('status')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.raffles.index') }}" class="btn btn-secondary">Voltar</a>
                            <button type="submit" class="btn btn-success">{{ $mode === 'edit' ? 'Salvar alterações' : 'Cadastrar sorteio' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
