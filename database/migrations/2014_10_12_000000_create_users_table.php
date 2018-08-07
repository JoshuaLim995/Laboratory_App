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
            $table->string('username')->unique();
            $table->string('department');
            $table->string('programme')->nullable();
            $table->string('supervisor')->nullable();
            $table->string('work_bench')->nullable();
            $table->string('office')->nullable();
            $table->string('contact');
            $table->string('approved', 1);
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            [
            'name' => 'DLMSA',
            'email' => 'dlmsa@dlmsa.com',
            'password' => '$2y$10$W//dtyXI/J5xv0cN34.j0OqyY8XWHqEHrWJSNx4HVOkh109qEwEee',
            'username' => 'dlmsa',
            'department' => 'Science',
            'contact' => '0119488293',
            'approved' => '1',
            ],
            [
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => '$2y$10$W//dtyXI/J5xv0cN34.j0OqyY8XWHqEHrWJSNx4HVOkh109qEwEee',
            'username' => 'admin',
            'department' => 'Lab',
            'contact' => '0119494949',
            'approved' => '1',
            ],
            [
            'name' => 'Student',
            'email' => 'student@student.com',
            'password' => '$2y$10$W//dtyXI/J5xv0cN34.j0OqyY8XWHqEHrWJSNx4HVOkh109qEwEee',
            'username' => 'student',
            'department' => 'FES',
            'contact' => '01148590532',
            'approved' => '1',
            ],
            [
            'name' => 'Dummy',
            'email' => 'dummy@dummy.com',
            'password' => '$2y$10$W//dtyXI/J5xv0cN34.j0OqyY8XWHqEHrWJSNx4HVOkh109qEwEee',
            'username' => 'dummy',
            'department' => 'Dummy',
            'contact' => '01148590532',
            'approved' => '1',
            ],
            [
            'name' => 'Assistant',
            'email' => 'ass@ass.com',
            'password' => '$2y$10$W//dtyXI/J5xv0cN34.j0OqyY8XWHqEHrWJSNx4HVOkh109qEwEee',
            'username' => 'assistant',
            'department' => 'Assistant',
            'contact' => '01148590532',
            'approved' => '1',
            ],
            [
            'name' => 'Academic Staff',
            'email' => 'acc@acc.com',
            'password' => '$2y$10$W//dtyXI/J5xv0cN34.j0OqyY8XWHqEHrWJSNx4HVOkh109qEwEee',
            'username' => 'acd',
            'department' => 'fda',
            'contact' => '01148590532',
            'approved' => '1',
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
