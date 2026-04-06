<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => UserRole::ADMIN]);
        $managerRole = Role::firstOrCreate(['name' => UserRole::MANAGER]);

        $testAdmin = User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'test.admin@test.com',
            'password' => bcrypt('password'),
        ]);
        $testAdmin->assignRole($adminRole);

        $admin = User::factory()->create();
        $admin->assignRole($adminRole);

        $testManager = User::factory()->create([
            'name' => 'Test Manager',
            'email' => 'test.manager@test.com',
            'password' => bcrypt('password'),
        ]);
        $testManager->assignRole($managerRole);

        $managers = User::factory(5)->create();
        $managers->each(
            fn($manager) => $manager->assignRole($managerRole)
        );
    }
}
