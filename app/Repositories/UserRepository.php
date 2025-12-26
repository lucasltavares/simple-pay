<?php

namespace App\Repositories;
use App\Models\User;

class UserRepository
{
    public function create(User $user): User
    {
        return User::create($user->toArray());
    }

    public function update(User $user): bool
    {
        return $user->update($user->toArray());
    }

    public function delete(User $user): bool
    {
        return $user->delete();
    }

    public function findUserById(int $id): User
    {
        return User::find($id);
    }

    public function findUserByEmail(string $email): User
    {
        return User::where('email', $email)->first();
    }

    public function findUserByCpf(string $cpf): User
    {
        return User::where('cpf', $cpf)->first();
    }

    public function findUserByCnpj(string $cnpj): User
    {
        return User::where('cnpj', $cnpj)->first();
    }
}