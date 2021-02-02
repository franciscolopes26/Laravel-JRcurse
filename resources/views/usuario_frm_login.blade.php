@extends('layouts.app')

{{-- FORMULÁRIO DE LOGIN --}}

@section('conteudo')

	<div class="row">
		
		<div class="col-md-4 col-md-offset-4	col-sm-8 col-sm-offset-2	col-xs-12">


		{{-- apresentação de erros de validação... e não só --}}
		@include('inc.erros')

		{{-- ========================================================= --}}
		<form method="POST" action="/usuario_executar_login">
			
			{{-- csrf --}}
			{{ csrf_field() }}

			{{-- usuario --}}
			<div class="form-group">
				<label for="id_text_usuario">Usuário:</label>
				<input type="text" class="form-control" id="id_text_usuario" name="text_usuario" placeholder="Usuário">
			</div>

			{{-- senha --}}
			<div class="form-group">
				<label for="id_text_senha">Senha:</label>
				<input type="password" class="form-control" id="id_text_senha" name="text_senha" placeholder="Senha">				
			</div>

			{{-- submeter --}}
			<div class="text-center">
				<button type="submit" class="btn btn-primary">Entrar</button>
			</div>

			{{-- link para recuperar senha --}}
			<div class="text-center margem-top-20">
				<a href="/usuario_frm_recuperar_senha">Recuperar senha</a>
			</div>

			{{-- link para criar nova conta de usuário --}}
			<div class="text-center">
				<a href="/usuario_frm_criar_conta">Criar nova conta</a>
			</div>

		</form>

			
		</div>

	</div>

@endsection