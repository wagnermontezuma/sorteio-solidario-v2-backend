@section('title', 'Confirmar Senha')
@extends('layouts.default')

@section('content')
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:;">Confirmar Senha</a></li>
    </ol>

    <h1 class="page-header">Confirmar Senha</h1>

    <div class="row d-flex justify-content-center">
        <div class="col-8">

            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Confirmar Senha</h4>
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

                    <h4 class="mb-4">Esta é uma área segura do aplicativo. Por favor, confirme sua senha antes de continuar.</h4>

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="row d-flex justify-content-center">

                            <div class="form-group col-6">
								<label for="password">Senha</label>
								{!! Form::password('password', ['class' => 'form-control', 'autocomplete' => 'current-password', 'required', 'autofocus']) !!}
							</div>

                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button class="btn btn-sm btn-primary" type="submit">Confirmar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
