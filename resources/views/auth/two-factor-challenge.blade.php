@extends('layouts.empty', ['paceTop' => true, 'bodyExtraClass' => 'bg-white'])

@section('title', 'Login Page')

@section('content')
	<div class="login login-with-news-feed">
		<div class="news-feed">
			@if (isset($config->config['layout']['background_image']) && $config->config['layout']['background_image'] != '')
			<div class="news-image text-white"
			style="background-image: url({{ route('imagem.render', "background_image/". $config->config['layout']['background_image']) }})">
			</div>
			@else
			<div class="news-image text-white"></div>
			@endif
			<div class="news-caption">
				<h4 class="caption-title"><b>Painel</b> Administrativo</h4>
				<p>
					Bem vindo(a) ao seu painel administrativo.
				</p>
			</div>
		</div>

		<div class="right-content">
			<div class="login-header">
				<div class="brand" style="width: 80%">
					<b>{{ $config->nome ?? 'Bredi' }}</b>
					<br>Controle
				</div>
				<div class="icon">
					@if (isset($config->config['layout']['logo']) && $config->config['layout']['logo'] != '')
					<div style="width: 80px" class="logo"><img src="{{ route('imagem.render', "company/p/". $config->config['layout']['logo']) }}" alt="" class="img-fluid"></div>
					@else
					<i class="fa fa-sign-in-alt"></i>
					@endif
				</div>
			</div>
			<div class="login-content">

                <form action="{{ route('two-factor.login') }}" method="POST" class="margin-bottom-0">
                    @csrf

                    <h4 class="mb-4">Por favor, confirme o acesso à sua conta digitando o código da autenticação provido pelo seu aplicativo autenticador.</h4>

                    <div class="form-group m-b-15">
                        <input type="text" name="code" id="code" class="form-control form-control-lg" placeholder="Código" autofocus inputmode="numeric" />
                    </div>

                    <h4 class="mb-4">Ou, se você perdeu o seu dispositivo, digite o código de recuperação.</h4>

                    <div class="form-group m-b-15">
                        <input type="recovery_code" name="recovery_code" class="form-control form-control-lg" placeholder="Código de Recuperação" />
                    </div>

					<div class="login-buttons">
						<button type="submit" class="btn btn-warning btn-block btn-lg">Entrar</button>
					</div>
					<hr />
					<p class="text-center text-grey-darker mb-0">
						&copy; {{ $config->nome ?? 'Bredi' }} todos os direitos reservados {{ date('Y') }}
					</p>
				</form>
			</div>
		</div>
	</div>
@endsection
