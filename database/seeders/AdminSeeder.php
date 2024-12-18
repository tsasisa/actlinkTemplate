<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert([
            'userName' => 'Admin',
            'userEmail' => 'admin@gmail.com',
            'userPassword' => Hash::make('admin123'),
            'userPhoneNumber' => null,
            'userImage' => null,
            'userType' => 'admin',
        ]);
    }
}
