<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService
{
    public function createUser(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function updateUser(string $id, array $data): ?User
    {
        $user = User::find($id);
        if (!$user) {
            return null;
        }

        $user->update($data);
        return $user;
    }

    public function deleteUser(string $id): bool
    {
        $user = User::find($id);
        if (!$user) {
            return false;
        }

        return $user->delete();
    }

    public function getAllUsers(): LengthAwarePaginator
    {
        return User::select('id', 'name', 'email')
            ->withTrashed()
            ->paginate(10);
    }

    public function findUserById(string $id): ?User
    {
        return User::find($id);
    }
}
