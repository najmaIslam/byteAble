<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $admin = Role::create(['name' => 'admin']);
        $editor = Role::create(['name' => 'editor']);
        $user = Role::create(['name' => 'user']);

        // Create permissions middleware('permission:create post');
        $listData = Permission::create(['name' => 'show data']);
        $createData = Permission::create(['name' => 'create data']);
        $editData = Permission::create(['name' => 'edit data']);
        $deleteData = Permission::create(['name' => 'delete data']);

        // Assign permissions to roles
        $admin->givePermissionTo($listData,$createData ,$editData, $deleteData);
        $editor->givePermissionTo($createData, $editData);
        $user->givePermissionTo($createData);
            }
}
