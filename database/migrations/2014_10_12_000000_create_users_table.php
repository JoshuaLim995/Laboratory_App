<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            [
            'name' => '123',
            'email' => '123@123.com',
            'password' => '$2y$10$W//dtyXI/J5xv0cN34.j0OqyY8XWHqEHrWJSNx4HVOkh109qEwEee',
            ],
            [
            'name' => 'HOD',
            'email' => 'HOD@UTAR.my',
            'password' => '$2y$10$W//dtyXI/J5xv0cN34.j0OqyY8XWHqEHrWJSNx4HVOkh109qEwEee',
            ],
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
