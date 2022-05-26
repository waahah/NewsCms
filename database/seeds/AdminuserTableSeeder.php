<?php

use Illuminate\Database\Seeder;

class AdminuserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $salt = md5(uniqid(microtime(), true));
        $password = md5(md5('123456'). $salt);
        DB::table('admin_user')->insert([
            [
                'id' => 2,
                'username' => 'admin',
                'password' => $password,
                'salt' => $salt
            ],
        ]);

    }
}
