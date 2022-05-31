<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();

        $user = Admin::create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'Admin@gmail.com',
            'password' => bcrypt('123456'),
            'activation' => 1,
        ]);
    }
}