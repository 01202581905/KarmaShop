<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(usersSeeder::class);
    }
}

class usersSeeder extends Seeder
{
	public function run()
	{
		DB::table('users')->insert([
        	'name'	=> 'Tâm',
        	'email'	=> 'tam0310@gmail.com',
        	'password'	=> bcrypt('123456789'),
        	'address'	=> 'Hue',
        	'phone'		=> '0702581905',
        	'rule'		=> 1,
        	'status'	=> 1,
        ]);

        DB::table('users')->insert([
            'name'  => 'Phụng',
            'email' => 'trongphoenix@gmail.com',
            'password'  => bcrypt('123456789'),
            'address'   => 'Quảng Nam',
            'phone'     => '0702581905',
            'rule'      => 0,
            'status'    => 1,
        ]);

        DB::table('users')->insert([
            'name'  => 'Viết Sỉ',
            'email' => 'si1999@gmail.com',
            'password'  => bcrypt('123456789'),
            'address'   => 'Quảng Trị',
            'phone'     => '0702581905',
            'rule'      => 0,
            'status'    => 0,
        ]);

        Schema::table('users',function($table){
            $table->int('status_shop');
            $table->text('avatar_shop');
            $table->text('name_shop');
            $table->text('address_shop');
            $table->text('fanpage_facebook');
        });
	}
}