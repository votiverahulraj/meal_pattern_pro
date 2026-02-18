<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    public function run()
    {
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'district']);
        Role::create(['name' => 'user']);

        // Assign admin role to the first user if exists
        $user = User::first();
        if ($user) {
            $user->assignRole('admin');
        }
    }
}
