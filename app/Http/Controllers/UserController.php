<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserController extends Controller
{
    private $userRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Lista todos os usuários cadastrados
     *
     * @param UserRepositoryInterface $userRepository
     *
     * @return view
     */
    public function index()
    {
        $usuarios = $this->userRepository->allWithPostCount();

        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Mostra o formulário de criação de um novo usuário
     *
     * @return view
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Mostra os detalhes do usuário
     *
     * @param  int $id
     *
     * @return view|response
     */
    public function show(int $id)
    {
        $usuario = $this->userRepository->findOrFail($id);

        return view('usuarios.show', compact('usuario'));
    }

    /**
     * Cria novo usuário
     *
     * @param Request $request
     *
     * @return response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name'     => 'required|string',
                'position' => 'required|string',
                'email'    => 'required|email|unique:users',
            ]);

            $this->userRepository->create($request->all());

            return redirect()->route('usuarios.index')->with('success', 'Usuário criado com sucesso');
        } catch (\Illuminate\Validation\ValidationException $validationException) {

            return redirect()->route('usuarios.create')->withErrors($validationException->errors())->withInput();
        } catch (\Throwable $th) {

            return redirect()->route('usuarios.index')->with('error', 'Erro ao criar o usuário');
        }
    }

    /**
     * Excluir um usuário
     *
     * @param  int $id
     *
     * @return response
     */
    public function destroy(int $id)
    {
        try {
            $this->userRepository->destroy($id);

            return redirect()->route('usuarios.index')->with('success', 'Usuário excluído com sucesso');
        } catch (\Throwable $th) {
            return redirect()->route('usuarios.index')->with('error', 'Erro ao excluir o usuário');
        }
    }
}
