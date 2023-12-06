<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parts', function (Blueprint $table) {
            $table->id('PartID');
            $table->index('PartID');
            $table->string('Name');
            $table->foreignId('FKBrandID')->references('BrandID')->on('brands');
            $table->foreignId('FKPartTypeID')->references('PartTypeID')->on('parttypes');
            $table->longText('Specifications');
            $table->decimal('Price', 8, 2);
            $table->integer('Stock')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parts');
    }
};
