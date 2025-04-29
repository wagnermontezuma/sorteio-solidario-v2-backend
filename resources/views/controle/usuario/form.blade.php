@section('title', 'Cadastrar Usuários')
@extends('layouts.default')

@section('content')
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:;">Cadastrar Usuários</a></li>
    </ol>

    <h1 class="page-header">Usuários</h1>

    <div class="row">
        <div class="col-md-6">

            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">{{isset($user) ? 'Atualização de Usuários' : 'Cadastro de Usuários'}}</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                            data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                            data-click="panel-reload"><i class="fa fa-redo"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                            data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
                            data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                </div>

                <div class="panel-body">
                    @if (isset($user->id))
                        {!! html()->form('POST', route('controle.usuario.update', $user->id))->open() !!}
                    @else
                        {!! html()->form('POST', route('controle.usuario.store'))->open() !!}
                    @endif
                    <fieldset>

                        <div class="form-group">
                            {!! html()->label('Grupo Usuário', 'roles') !!}
                            {!! html()->select('roles', $roles ? [null => 'Selecione'] + $roles : [null => 'Nenhuma grupo cadastrado'], isset($user) ? $user->roles->first()->name : null)
                                ->class('form-control')
                                ->required() !!}
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                {!! html()->label('Nome', 'name') !!}
                                {!! html()->text('name', $user->name ?? null)->class('form-control')->required() !!}
                            </div>

                            <div class="form-group col-6">
                                {!! html()->label('Email', 'email') !!}
                                {!! html()->text('email', $user->email ?? null)->class('form-control')->required() !!}
                            </div>
                        </div>

                        @if (isset($user->id))

                        <div class="row">
                            <div class="form-group col-6">
                                {!! html()->label('Senha ( Deixe em branco caso não deseje alterar )', 'password') !!}
                                {!! html()->password('password')->class('form-control') !!}
                            </div>

                            <div class="form-group col-6">
                                {!! html()->label('Confirmar a senha', 'password_confirmation') !!}
                                {!! html()->password('password_confirmation')->class('form-control') !!}
                            </div>
                        </div>

                        @else

                        <div class="row">
                            <div class="form-group col-6">
                                {!! html()->label('Senha', 'password') !!}
                                {!! html()->password('password')->class('form-control')->required() !!}
                            </div>

                            <div class="form-group col-6">
                                {!! html()->label('Confirmar a senha', 'password_confirmation') !!}
                                {!! html()->password('password_confirmation')->class('form-control')->required() !!}
                            </div>
                        </div>

                        @endif

                        <button type="submit" class="btn btn-sm btn-primary m-r-5">Salvar</button>
                        <a href="{{ route('controle.usuario.index') }}" class="btn btn-sm btn-default">Cancelar</a>

                    </fieldset>
                    {!! html()->form()->close() !!}
                </div>

            </div>

        </div>
    </div>
@endsection
