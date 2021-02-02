

{{-- apresentação dos erros de validação --}}
@if(count($errors) != 0)

	<div class="alert alert-danger">

		{{-- título da caixa de erros --}}
		@if(count($errors) == 1)
			<p class="titulo-erro">ERRO:</p>
		@else
			<p class="titulo-erro">ERROS:</p>
		@endif

		{{-- apresentar os erros (concatenação) --}}
		<ul>
			@foreach($errors->all() as $erro)
				<li>{{ $erro }}</li>
			@endforeach
		</ul>

	</div>

@endif

{{-- apresentação dos erros de comunicação com a bd --}}
@if(isset($erros_bd))
	<div class="alert alert-danger">
		@foreach ($erros_bd as $erro)
			<p>{{ $erro }}</p>
		@endforeach
	</div>
@endif