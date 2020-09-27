<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * Class PermissionRoleTableSeeder.
 */
class PermissionRoleTableSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();

        // Create Roles

        // Super Admin
        $superAdmin = Role::create(['name' => config('access.users.super_admin_role')]);

        // Admin Role
        $admin = Role::create(['name' => config('access.users.admin_role')]);

        // Create Permissions
        Permission::create(['name' => 'view backend']);

        // Assign Permissions to other Roles
        // Note: Admin (User 1) Has all permissions via a gate in the AuthServiceProvider
        $superAdmin->givePermissionTo('view backend');
        $admin->givePermissionTo('view backend');
        $this->enableForeignKeys();
    }
}
