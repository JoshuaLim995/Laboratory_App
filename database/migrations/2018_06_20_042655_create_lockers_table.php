<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLockersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lockers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('locker_no');
            $table->integer('floor_no');
            $table->char('type', 1);
            $table->integer('availablity');
            $table->timestamps();
            // $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            // $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        DB::table('lockers')->insert([
            [ 'locker_no' => '001', 'floor_no' => '5', 'type' => 'A', 'availablity' => '1', ], 
            [ 'locker_no' => '002', 'floor_no' => '6', 'type' => 'B', 'availablity' => '1', ], 
            [ 'locker_no' => '003', 'floor_no' => '7', 'type' => 'A', 'availablity' => '1', ], 
            [ 'locker_no' => '004', 'floor_no' => '8', 'type' => 'B', 'availablity' => '1', ], 

            [ 'locker_no' => '005', 'floor_no' => '5', 'type' => 'A', 'availablity' => '1', ], 
            [ 'locker_no' => '006', 'floor_no' => '6', 'type' => 'B', 'availablity' => '1', ], 
            [ 'locker_no' => '007', 'floor_no' => '7', 'type' => 'A', 'availablity' => '1', ], 
            [ 'locker_no' => '008', 'floor_no' => '8', 'type' => 'B', 'availablity' => '1', ], 

            [ 'locker_no' => '009', 'floor_no' => '5', 'type' => 'A', 'availablity' => '1', ], 
            [ 'locker_no' => '010', 'floor_no' => '6', 'type' => 'B', 'availablity' => '1', ], 
            [ 'locker_no' => '011', 'floor_no' => '7', 'type' => 'A', 'availablity' => '1', ], 
            [ 'locker_no' => '012', 'floor_no' => '8', 'type' => 'B', 'availablity' => '1', ], 

            [ 'locker_no' => '013', 'floor_no' => '5', 'type' => 'A', 'availablity' => '1', ], 
            [ 'locker_no' => '014', 'floor_no' => '6', 'type' => 'B', 'availablity' => '1', ], 
            [ 'locker_no' => '015', 'floor_no' => '7', 'type' => 'A', 'availablity' => '1', ], 
            [ 'locker_no' => '016', 'floor_no' => '8', 'type' => 'B', 'availablity' => '1', ], 

            [ 'locker_no' => '017', 'floor_no' => '5', 'type' => 'A', 'availablity' => '1', ], 
            [ 'locker_no' => '018', 'floor_no' => '6', 'type' => 'B', 'availablity' => '1', ], 
            [ 'locker_no' => '019', 'floor_no' => '7', 'type' => 'A', 'availablity' => '1', ], 
            [ 'locker_no' => '020', 'floor_no' => '8', 'type' => 'B', 'availablity' => '1', ], 

            [ 'locker_no' => '021', 'floor_no' => '5', 'type' => 'A', 'availablity' => '1', ], 
            [ 'locker_no' => '022', 'floor_no' => '6', 'type' => 'B', 'availablity' => '1', ], 
            [ 'locker_no' => '023', 'floor_no' => '7', 'type' => 'A', 'availablity' => '1', ], 
            [ 'locker_no' => '024', 'floor_no' => '8', 'type' => 'B', 'availablity' => '1', ], 

            [ 'locker_no' => '025', 'floor_no' => '5', 'type' => 'A', 'availablity' => '1', ], 
            [ 'locker_no' => '026', 'floor_no' => '6', 'type' => 'B', 'availablity' => '1', ], 
            [ 'locker_no' => '027', 'floor_no' => '7', 'type' => 'A', 'availablity' => '1', ], 
            [ 'locker_no' => '028', 'floor_no' => '8', 'type' => 'B', 'availablity' => '1', ], 

            [ 'locker_no' => '029', 'floor_no' => '5', 'type' => 'A', 'availablity' => '1', ], 
            [ 'locker_no' => '030', 'floor_no' => '6', 'type' => 'B', 'availablity' => '1', ], 
            [ 'locker_no' => '031', 'floor_no' => '7', 'type' => 'A', 'availablity' => '1', ], 
            [ 'locker_no' => '032', 'floor_no' => '8', 'type' => 'B', 'availablity' => '1', ], 

            [ 'locker_no' => '033', 'floor_no' => '5', 'type' => 'A', 'availablity' => '1', ], 
            [ 'locker_no' => '034', 'floor_no' => '6', 'type' => 'B', 'availablity' => '1', ], 
            [ 'locker_no' => '035', 'floor_no' => '7', 'type' => 'A', 'availablity' => '1', ], 
            [ 'locker_no' => '036', 'floor_no' => '8', 'type' => 'B', 'availablity' => '1', ], 

            [ 'locker_no' => '037', 'floor_no' => '5', 'type' => 'A', 'availablity' => '1', ], 
            [ 'locker_no' => '038', 'floor_no' => '6', 'type' => 'B', 'availablity' => '1', ], 
            [ 'locker_no' => '039', 'floor_no' => '7', 'type' => 'A', 'availablity' => '1', ], 
            [ 'locker_no' => '040', 'floor_no' => '8', 'type' => 'B', 'availablity' => '1', ], 

            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lockers');
    }
}
