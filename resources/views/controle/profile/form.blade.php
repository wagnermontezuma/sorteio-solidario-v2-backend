@extends('layouts.default')

@section('content')

    <ol class="breadcrumb pull-right"></ol>

    <h1 class="page-header">
        Usuário
    </h1>

    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-inverse" data-sortable-id="form-stuff-9">
                <div class="panel-heading">
                    <h4 class="panel-title">Usuário</h4>
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
                    {!! html()->form('POST', isset($user->id) ? route('admin.profile.update', $user->id) : route('admin.profile.store'))->attribute('enctype', 'multipart/form-data')->open() !!}
                        <fieldset>
                            <div class="form-group">
                                {!! html()->label('Foto', 'imagem') !!}
                                @if(!empty($user->imagem))
                                <div>
                                    <img src="{{ route('imagem.render', 'user/p/' . $user->imagem) }}" alt="" class="img-fluid">
                                </div>
                                @endif
                                {!! html()->file('imagem')->class('form-control') !!}
                            </div>
                            <div class="form-group">
                                {!! html()->label('Nome', 'name') !!}
                                {!! html()->text('name', $user->name ?? null)->class('form-control') !!}
                            </div>
                            <div class="form-group">
                                {!! html()->label('E-mail', 'email') !!}
                                {!! html()->email('email', $user->email ?? null)->class('form-control') !!}
                            </div>
                            <hr>
                            <div class="form-group">
                                {!! html()->label('Alterar Senha', 'password') !!}
                                {!! html()->password('password')->class('form-control')->placeholder('Nova senha') !!}
                            </div>
                            <div class="form-group">
                                {!! html()->label('Informe a senha atual', 'actual_password') !!}
                                {!! html()->password('actual_password')->class('form-control')->placeholder('Senha atual') !!}
                            </div>
                            {!! html()->button('Salvar')->type('submit')->class('btn btn-sm btn-primary m-r-5') !!}
                        </fieldset>
                    {!! html()->form()->close() !!}
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="panel panel-inverse" data-sortable-id="form-stuff-9">
                <div class="panel-heading">
                    <h4 class="panel-title">Autenticação de Dois Fatores</h4>
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

                    <form method="POST" action="{{ route('two-factor.enable') }}">
                        @csrf

                        <div class="d-flex flex-column justify-content-center align-items-center">
                            @if (auth()->user()->two_factor_secret)
                                @method('DELETE')

                                <div class="alert alert-success" role="alert">
                                    A autenticação de duas etapas agora está habilitada.
                                </div>

                                <b class="mb-3">Escanei o QR CODE a seguir usando aplicativo Google Authenticator no seu telefone.</b>

                                <div>
                                    {!! auth()->user()->twoFactorQrCodeSvg() !!}
                                </div>

                                <br>

                                <b>Armazene esses códigos de recuperação em um local seguro.</b>
                                <b class="mb-3">Eles podem ser utilizados para recuperar o acesso à sua conta caso você perca o seu telefone.</b>

                                @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes), true) as $code)
                                    <p>{{ $code }}</p>
                                @endforeach

                                <br>

                                <button type="submit" class="btn btn-danger">
                                    Desabilitar
                                </button>
                            @else
                                <div class="alert alert-warning" role="alert">
                                    A autenticação de dois fatores está desativada
                                </div>

                                <b class="text-center mb-3">
                                    Quando autenticação de duas etapas for habilitado, você será solicitado a fornecer um
                                    token seguro e aleatório durante a autenticação. Este código é gerado pelo aplicativo
                                    Google Authenticator no seu telefone.
                                </b>

                                <button type="submit" class="btn btn-success">
                                    Habilitar
                                </button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop
