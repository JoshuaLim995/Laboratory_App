<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inventory_id');
            $table->string('room_no');
            $table->string('floor_no');
            $table->integer('quantity');
            $table->timestamps();
        });

        DB::table('item_locations')->insert([
            [
            'inventory_id' => '1',
            'room_no' => 'KB513',
            'floor_no' => '5',
            'quantity' => '10',
            ],
            [            
            'inventory_id' => '1',
            'room_no' => 'KB613',
            'floor_no' => '6',
            'quantity' => '5',
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
        Schema::dropIfExists('item_locations');
    }
}
