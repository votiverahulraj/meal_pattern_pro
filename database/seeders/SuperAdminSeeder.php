<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles if they don't exist
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $districtRole = Role::firstOrCreate(['name' => 'district']);
        
        // Create a super admin user
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password'),
        ]);
        
        // Assign admin role to the super admin
        $superAdmin->assignRole('admin');
        
        echo "Super Admin created successfully!\n";
        echo "Email: superadmin@example.com\n";
        echo "Password: password\n";
    }
}
