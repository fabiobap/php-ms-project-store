<?php

namespace App\Actions\Auth;

use App\DTO\NewUserCustomerDTO;
use App\Enums\RoleNames;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterNewCustomer
{

    public function handle(NewUserCustomerDTO $dto): User
    {
        return User::create([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => Hash::make($dto->password),
            'role_id' => Role::where('name', RoleNames::CUSTOMER)->first()->id
        ]);
    }
}
