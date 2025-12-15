<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::updateOrCreate(
            ['email' => 'admin@toolsfree.org'],
            [
                'name' => 'Admin',
                'email' => 'admin@toolsfree.org',
                'password' => Hash::make('Admin@123'),
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('✓ Admin user created successfully!');
        $this->command->info('  Email: admin@toolsfree.org');
        $this->command->info('  Password: Admin@123');
        $this->command->warn('  ⚠️  Please change the password after first login!');
    }
}
