<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        DB::table('admins')->insert([
            'name' => 'admin0',
            'birth_date' => '2020/09/10',
            'email' => 'admin0@gmail.com',
            'password' => Hash::make('123456789'),
        ]);

        $admin = DB::table('admins')->where('email', '=', 'admin0@gmail.com')
                    ->select('id')
                    ->first();
        
        DB::table('profile')->insert([
            'admin_id' => $admin->id,
        ]);
    }
}
