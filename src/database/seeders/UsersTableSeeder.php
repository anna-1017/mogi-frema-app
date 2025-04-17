<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([

            [
                'name' => 'テストユーザー1',
                'email' => 'test1@example.com',
                'password' => Hash::make('password1'),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'テストユーザー2',
                'email' => 'test2@example.com',
                'password' => Hash::make('password2'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
