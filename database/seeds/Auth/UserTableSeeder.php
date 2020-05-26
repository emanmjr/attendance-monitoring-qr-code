<?php

use App\Models\Auth\User;
use Illuminate\Database\Seeder;

/**
 * Class UserTableSeeder.
 */
class UserTableSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();

        // Add the master administrator, user id of 1
        $user1 =User::create([
            'first_name' => 'Super',
            'middle_name' => 'Admin',
            'last_name' => 'Istrator',
            'email' => 'super@admin.com',
            'password' => 'secret',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed' => true,
        ]);

        $user2 = User::create([
            'first_name' => 'Default',
            'middle_name' => 'User',
            'last_name' => 'Admin',
            'email' => 'admin@user.com',
            'password' => 'secret',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed' => true,
        ]);

        $user3 = User::create([
            'first_name' => 'Default',
            'middle_name' => 'User',
            'last_name' => 'Customer Service',
            'email' => 'customer-service@user.com',
            'password' => 'secret',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed' => true,
        ]);

        $user4 = User::create([
            'first_name' => 'Default',
            'middle_name' => 'User',
            'last_name' => 'Manager',
            'email' => 'manager@user.com',
            'password' => 'secret',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed' => true,
        ]);


        $this->enableForeignKeys();
    }
}
