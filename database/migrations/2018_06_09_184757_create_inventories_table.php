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
            $table->string('model');
            $table->text('description');
            $table->integer('quantity');
            $table->string('photo')->nullable();
            $table->timestamps();
        });

        DB::table('inventories')->insert([
            [
            'name' => 'Beaker',
            'model' => '100',
            'description' => 'beaker-beaker',
            'quantity' => '10',
            ],
            [
            'name' => 'Cup',
            'model' => '123',
            'description' => 'cup-cup',
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
        Schema::dropIfExists('inventories');
    }
}
