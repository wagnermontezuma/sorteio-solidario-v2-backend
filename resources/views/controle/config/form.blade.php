@extends('layouts.default')

@section('content')

    <h1 class="page-header">Configurações</h1>

    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Atualização das configurações</h4>
                    <div class="panel-heading-btn">
                        {!! html()->a('javascript:;')->class('btn btn-xs btn-icon btn-circle btn-default')->attribute('data-click', 'panel-expand')->html('<i class="fa fa-expand"></i>') !!}
                        {!! html()->a('javascript:;')->class('btn btn-xs btn-icon btn-circle btn-success')->attribute('data-click', 'panel-reload')->html('<i class="fa fa-redo"></i>') !!}
                        {!! html()->a('javascript:;')->class('btn btn-xs btn-icon btn-circle btn-warning')->attribute('data-click', 'panel-collapse')->html('<i class="fa fa-minus"></i>') !!}
                        {!! html()->a('javascript:;')->class('btn btn-xs btn-icon btn-circle btn-danger')->attribute('data-click', 'panel-remove')->html('<i class="fa fa-times"></i>') !!}
                    </div>
                </div>
                <div class="panel-body">
                    {!! html()->form('POST', route('controle.config.update'))->attribute('enctype', 'multipart/form-data')->open() !!}
                        <fieldset>
                            <div class="form-group">
                                {!! html()->label('Nome do projeto', 'nome') !!}
                                {!! html()->text('nome', $config->nome ?? null)->class('form-control')->required() !!}
                            </div>
                            <div class="form-group">
                                {!! html()->label('Logo da empresa', 'logo') !!}
                                @if(isset($config->config['layout']['logo']))
                                <div class="col-sm-4">
                                    <img src="{{ route('imagem.render', "company/p/". $config->config['layout']['logo']) }}" alt="" class="img-fluid">
                                </div>
                                @endif
                                {!! html()->file('logo')->class('form-control') !!}
                            </div>
                            <div class="form-group">
                                {!! html()->label('Background Login', 'background_image') !!}
                                @if(isset($config->config['layout']['background_image']))
                                <div class="col-sm-4">
                                    <img src="{{ route('imagem.render', "background_image/". $config->config['layout']['background_image']) }}" alt="" class="img-fluid">
                                </div>
                                @endif
                                {!! html()->file('background_image')->class('form-control') !!}
                            </div>

                            @can('controle.config.update')
                                <button type="submit" class="btn btn-sm btn-primary m-r-5"> Salvar</button>
                            @endcan
                        </fieldset>
                    {!! html()->form()->close() !!}
                </div>
            </div>
        </div>
    </div>

@stop
