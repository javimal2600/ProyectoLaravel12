<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $roles = [
            'Admin'=>[
                'access dashboard',
                'manage categories',
                'manage posts',
                'manage permissions',
                'manage roles',
                'manage users',
            ],
            'blogger'=>[
                'access dashboard',
                'manage categories',
                'manage posts',
            ],
        ];

        foreach($roles as $name => $permissions){
            $role = Role::create(['name'=>$name]);
            $role->syncPermissions($permissions);

        }
    }
}
