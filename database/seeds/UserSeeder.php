<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $user = User::create([
            'first_name' => 'user',
            'last_name' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('123456'),
            'activation' => 1,
        ]);
    }
}
