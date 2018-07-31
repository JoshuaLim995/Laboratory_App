<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            // $table->string('model');
            // $table->text('description')->nullable();
            $table->string('photo')->nullable();
            // $table->integer('category_id');
            // $table->string('asset_code')->nullable();
            $table->string('category', 3);
            // $table->string('room');
            // $table->string('floor_no');
            // $table->integer('quantity');
            $table->string('measurement_unit');
            $table->timestamps();
        });

        DB::table('inventories')->insert([
            [
            'name' => 'Beaker',
            // 'model' => '100',
            // 'description' => 'beaker-beaker',
            // 'category_id' => '1',
            'category' => 'gls',
            // 'room' => 'KB513',
            // 'floor_no' => '5',
            // 'quantity' => '10',
            'measurement_unit' => 'unit',
            ],
            [
            'name' => 'Cup',
            // 'model' => '123',
            // 'description' => 'cup-cup',
            // 'category_id' => '1',
            'category' => 'gls',
            // 'room' => 'KB613',
            // 'floor_no' => '6',
            // 'quantity' => '5',
            'measurement_unit' => 'unit',
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
        Schema::dropIfExists('inventories');
    }
}
