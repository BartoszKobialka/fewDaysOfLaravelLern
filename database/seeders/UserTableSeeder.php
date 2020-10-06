<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'tmp2',
            'email' => 'kobialkabartosz3bi@gmail.com',
            'password' => Hash::make('1234'),
        ]);
    }
}
