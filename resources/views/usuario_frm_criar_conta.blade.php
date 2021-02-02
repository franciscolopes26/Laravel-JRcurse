@extends('layouts.app')

{{-- CRIAR NOVA CONTA DE USUÁRIO --}}

@section('conteudo')

	<div class="row">
		
		<div class="col-md-4 col-md-offset-4	col-sm-8 col-sm-offset-2	col-xs-12">

		{{-- apresentação de erros de validação... e não só --}}
		@include('inc.erros')

		{{-- ========================================================= --}}
		<form method="POST" action="/usuario_executar_criar_conta">
			
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

			{{-- repetir senha --}}
			<div class="form-group">
				<label for="id_text_senha_repetida">Repetir senha:</label>
				<input type="password" class="form-control" id="id_text_senha_repetida" name="text_senha_repetida" placeholder="Repetir senha">				
			</div>

			{{-- email --}}
			<div class="form-group">
				<label for="id_text_email">Email:</label>
				<input type="text" class="form-control" id="id_text_email" name="text_email" placeholder="Email">
			</div>


			{{-- aceitação das condições do serviço --}}
			<div class="form-group text-center">
				<input type="checkbox" id="id_check_termos_condicoes" name="check_termos_condicoes" value="1">
				<label for="id_check_termos_condicoes"> Concordo com os termos e condições.</label>
			</div>

			{{-- submeter --}}
			<div class="text-center">
				<button type="submit" class="btn btn-primary">Criar nova conta</button>
			</div>			

			{{-- voltar ao início --}}
			<div class="text-center margem-top-20">
				<a href="/">Voltar</a>
			</div>

		</form>

			
		</div>

	</div>

@endsection