<?php

declare(strict_types=1);

namespace Database\Seeders\User;

use App\Enums\UserRole;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => UserRole::ADMIN]);
        $managerRole = Role::firstOrCreate(['name' => UserRole::MANAGER]);

        $admin = User::factory()->create();
        $admin->assignRole($adminRole);

        $managers = User::factory(5)->create();
        $managers->each(
            fn($manager) => $manager->assignRole($managerRole)
        );
    }
}
