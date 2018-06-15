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
            $table->string('photo')->nullable();
            $table->integer('category_id');
            $table->timestamps();
        });

        DB::table('inventories')->insert([
            [
            'name' => 'Beaker',
            'model' => '100',
            'description' => 'beaker-beaker',
            'category_id' => '1',
            ],
            [
            'name' => 'Cup',
            'model' => '123',
            'description' => 'cup-cup',
            'category_id' => '1',
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
