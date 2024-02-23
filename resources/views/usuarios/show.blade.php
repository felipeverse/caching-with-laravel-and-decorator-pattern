@extends('layouts.app')

@section('content')

<div class="container mt-5">
	<div class="card">
	  <div class="card-header">
	    Detalhes do usuário
	  </div>
	  <div class="card-body">
	    <p>
		    <strong>Id:</strong> {{ $usuario->id }}
	    </p>
        <p>
		    <strong>Nome:</strong> {{ $usuario->name }}
	    </p>
        <p>
		    <strong>Cargo:</strong> {{ $usuario->position }}
	    </p>
        <p>
		    <strong>Email:</strong> {{ $usuario->email }}
	    </p>
        <a href="{{ route('usuarios.index') }}" class="float-right btn btn-dark">Voltar</a>
	  </div>
	</div>
</div>

@endsection
