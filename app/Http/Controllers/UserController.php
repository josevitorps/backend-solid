<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/**
 * Class UserController
 *
 * @package App\Http\Controllers
 * @author Vinícius Siqueira
 * @link https://github.com/ViniciusSCS
 * @date 2024-08-23 21:48:54
 * @copyright UniEVANGÉLICA
 */
class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Lista todos os usuários.
     */
    public function index(): JsonResponse
    {
        $users = $this->userService->getAllUsers();

        return response()->json([
            'status' => 200,
            'message' => 'Usuários encontrados!',
            'users' => $users
        ]);
    }

    /**
     * Cadastra um novo usuário.
     */
    public function store(UserCreateRequest $request): JsonResponse
    {
        $user = $this->userService->createUser($request->all());

        return response()->json([
            'status' => 201,
            'message' => 'Usuário cadastrado com sucesso!',
            'user' => $user
        ]);
    }

    /**
     * Mostra os detalhes de um usuário específico.
     */
    public function show(string $id): JsonResponse
    {
        $user = $this->userService->findUserById($id);

        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'Usuário não encontrado!',
            ]);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Usuário encontrado com sucesso!',
            'user' => $user
        ]);
    }

    /**
     * Atualiza os dados de um usuário existente.
     */
    public function update(UserUpdateRequest $request, string $id): JsonResponse
    {
        $user = $this->userService->updateUser($id, $request->all());

        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'Usuário não encontrado!',
            ]);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Usuário atualizado com sucesso!',
            'user' => $user
        ]);
    }

    /**
     * Remove um usuário do sistema.
     */
    public function destroy(string $id): JsonResponse
    {
        $deleted = $this->userService->deleteUser($id);

        if (!$deleted) {
            return response()->json([
                'status' => 404,
                'message' => 'Usuário não encontrado!',
            ]);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Usuário deletado com sucesso!'
        ]);
    }
}