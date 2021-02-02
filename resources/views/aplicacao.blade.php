@extends('layouts.app')

@section('conteudo')
	<p>Estou cá dentro!</p>
	<p>Usuário:<strong> {{ session('usuario') }}</strong></p>
	<a href="/usuario_logout">Logout</a>
@endsection