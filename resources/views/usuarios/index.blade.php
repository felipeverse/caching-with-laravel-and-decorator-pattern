@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            Listagem de usuários
            <a href="{{ route('usuarios.create') }}" class="btn btn-primary">Novo</a>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Profissão</th>
                                <th scope="col">Email</th>
                                <th scope="col">Posts</th>
                                <th scope="col" class="text-end">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $usuario)
                                <tr>
                                    <th scope="row">{{ $usuario->id }}</th>
                                    <td>{{ $usuario->name }}</td>
                                    <td>{{ $usuario->position }}</td>
                                    <td>{{ $usuario->email }}</td>
                                    <td>{{ $usuario->posts_count }}</td>
                                    <td class="text-end text-end">
                                        <div class="button-container">
                                            <a href="{{ route('usuarios.show', $usuario->id) }}" class="btn btn-primary text-white bi bi-eye"></a>
                                            <form method="POST" action="{{ route('usuarios.destroy', $usuario->id) }}" class="form d-inline-block" title="Exluir">
                                                @csrf
                                                @method('post')
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-danger bi bi-trash" title="Excluir"
                                                    onclick="return confirm('Tem certeza que deseja excluir o usuário?')"></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
