<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'System Admin', 'email' => 'admin@advisement.test', 'role' => UserRole::Admin],
            ['name' => 'OUR Staff', 'email' => 'our@advisement.test', 'role' => UserRole::Our],
            ['name' => 'Jane Adviser', 'email' => 'adviser@advisement.test', 'role' => UserRole::Adviser],
            ['name' => 'John Student', 'email' => 'student@advisement.test', 'role' => UserRole::Student],
            ['name' => 'Eval Staff', 'email' => 'evaluator@advisement.test', 'role' => UserRole::Evaluator],
        ];

        foreach ($users as $user) {
            User::query()->updateOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'role' => $user['role'],
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                ],
            );
        }
    }
}
