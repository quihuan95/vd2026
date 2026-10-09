<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@vduh.org'],
            [
                'name' => 'VDUH 2026 Administrator',
                'password' => Hash::make('vduh2026@admin'),
                'email_verified_at' => now(),
            ],
        );
    }
}
