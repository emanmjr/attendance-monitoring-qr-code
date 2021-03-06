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
            'is_password_changed' => 1,
            'confirmed' => true,
        ]);

        $user2 = User::create([
            'first_name' => 'Default',
            'middle_name' => 'User',
            'last_name' => 'Admin',
            'email' => 'admin@user.com',
            'password' => 'secret',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'is_password_changed' => 1,
            'confirmed' => true,
        ]);

        $user3 = User::create([
            'first_name' => 'John',
            'middle_name' => 'User',
            'last_name' => 'Doe',
            'email' => 'employee@user.com',
            'password' => 'secret',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'is_password_changed' => 1,
            'confirmed' => true,
        ]);

        

        $this->enableForeignKeys();
    }
}
