<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name'      => 'Admin',
                'email'     => 'admin@admin.com',
                'password'  => Hash::make('12345678'),
                'type'      => 'admin'
            ],
            [
                'name'      => 'Customer',
                'email'     => 'Customer@Customer.com',
                'password'  => Hash::make('12345678'),
                'type'      => 'Customer'
            ]
        ]);
    }
}
