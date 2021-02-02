@extends('layouts.app')

{{-- RECUPERAR SENHA --}}

@section('conteudo')

	<div class="row">
		
		<div class="col-md-4 col-md-offset-4	col-sm-8 col-sm-offset-2	col-xs-12">

		{{-- apresentação de erros de validação... e não só --}}
		@include('inc.erros')

		{{-- ========================================================= --}}
		<form method="POST" action="/usuario_executar_recuperar_senha">
			
			{{-- csrf --}}
			{{ csrf_field() }}			

			{{-- email --}}
			<div class="form-group">
				<label for="id_text_email">Email:</label>
				<input type="text" class="form-control" id="id_text_email" name="text_email" placeholder="Email">
			</div>

			{{-- submeter --}}
			<div class="text-center">
				<button type="submit" class="btn btn-primary">Recuperar senha</button>
			</div>			

			{{-- voltar ao início --}}
			<div class="text-center margem-top-20">
				<a href="/">Voltar</a>
			</div>

		</form>

			
		</div>

	</div>

@endsection