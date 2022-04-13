<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'super_admin@app.com',
            'password' => bcrypt('1234'),
        ]);

        $user->attachRole('super_admin');

    } // end of run

} // end of seeder
