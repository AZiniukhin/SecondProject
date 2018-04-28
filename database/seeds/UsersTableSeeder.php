<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
//        factory(App\User::class, 'userStatus', 1)->create([
//            'name' => 'Anton',
//            'status' => 'admin',
//            'email' => 'bl0w9un@gmail.com',
//            'email' => 'iambatman@gmail.com',
//            'password' => bcrypt('Z1pm2n3')
//        ]);
//        factory(App\User::class, 'userStatus', 1)->create([
//            'name' => 'Sergio',
//            'status' => 'admin',
//            'email' => 'bl0w9un@gmail.com',
//            'email' => 'iambatman@gmail.com',
//            'password' => bcrypt('123456')
//        ]);

        factory(App\User::class, 'userStatus', 1)->create([
            'name' => 'yakitory',
           'status' => 'client',
            'email' => 'yak@gmail.com',
            'password' => bcrypt('123')
        ]);
    }
}
