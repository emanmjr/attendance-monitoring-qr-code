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

        // Maker Role
        $maker = Role::create(['name' => config('access.users.cs_role')]);

        // Approver Role
        $approver = Role::create(['name' => config('access.users.manager_role')]);

        // Agent Role
        $agent = Role::create(['name' => config('access.users.agent_role')]);

        // Sub Agent Role
        $subAgent = Role::create(['name' => config('access.users.sub_agent_role')]);


        // Create Permissions
        Permission::create(['name' => 'view backend']);

        // Assign Permissions to other Roles
        // Note: Admin (User 1) Has all permissions via a gate in the AuthServiceProvider
        $superAdmin->givePermissionTo('view backend');
        $admin->givePermissionTo('view backend');
        $maker->givePermissionTo('view backend');
        $approver->givePermissionTo('view backend');
        $agent->givePermissionTo('view backend');
        $subAgent->givePermissionTo('view backend');

        $this->enableForeignKeys();
    }
}
