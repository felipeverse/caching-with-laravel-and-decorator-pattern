@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Novo usuário
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form method="POST" action="{{ route('usuarios.store') }}">
                            @csrf
                            <div class="mb-3">
                                {{-- Nome --}}
                                <label for="name" class="form-label">Nome</label>
                                <input type="text"
                                    class="form-control
                                    @error('name') is-invalid @enderror"
                                    id="name" name="name"
                                    value="{{ old('name', isset($usuario) ? $usuario->name : '') }}" required autofocus>

                                {{-- Position --}}
                                <label for="position" class="form-label">Cargo</label>
                                <input type="text" class="form-control @error('position') is-invalid @enderror"
                                    id="position" name="position"
                                    value="{{ old('position', isset($usuario) ? $usuario->position : '') }}" required>

                                {{-- Email --}}
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email"
                                    value="{{ old('email', isset($usuario) ? $usuario->email : '') }}" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                            <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
