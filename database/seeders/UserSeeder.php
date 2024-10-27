<?php

namespace Database\Seeders;

use App\Enums\RoleNames;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rAdmin= Role::factory()->create([
            'name' => RoleNames::ADMIN->value,
        ]);

        $rCustomer = Role::factory()->create([
            'name' => RoleNames::CUSTOMER->value,
        ]);

        User::factory()->admin()->create(
            ['email' => 'admin@admin.org']
        );

        User::factory()->customer()->create(
            ['email' => 'customer@customer.org']
        );

        $users = User::factory()
            ->count(120)
            ->state(new Sequence(
                ['role_id' => $rAdmin->id],
                ['role_id' => $rCustomer->id],
            ))
            ->create();
    }
}
