<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //insert a user into the database
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@localhost',
            'password' => Hash::make('admin'),
            'role' => 1, //admin
        ]);

        //insert a user into the database
        DB::table('users')->insert([
            'name' => 'user',
            'email' => 'user@localhost',
            'password' => Hash::make('user'),
            'role' => 0, //user
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('users')->where('name', 'admin')->delete();
    }
};
