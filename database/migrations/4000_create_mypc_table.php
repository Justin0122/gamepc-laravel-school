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
        Schema::create('my_pcs', function (Blueprint $table) {
            //
            $table->id('MyPcId');
            $table->foreignId('FKUserID')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('FKcpuId')->nullable()->references('PartID')->on('parts')->onDelete('cascade');
            $table->foreignId('FKgpuId')->nullable()->references('PartID')->on('parts')->onDelete('cascade');
            $table->foreignId('FKramId')->nullable()->references('PartID')->on('parts')->onDelete('cascade');
            $table->foreignId('FKmotherboardId')->nullable()->references('PartID')->on('parts')->onDelete('cascade');
            $table->foreignId('FKpsuId')->nullable()->references('PartID')->on('parts')->onDelete('cascade');
            $table->foreignId('FKstorageId')->nullable()->references('PartID')->on('parts')->onDelete('cascade');
            $table->foreignId('FKcaseId')->nullable()->references('PartID')->on('parts')->onDelete('cascade');
            $table->foreignId('FKcpucoolerId')->nullable()->references('PartID')->on('parts')->onDelete('cascade');
            $table->foreignId('FKcasecoolerId')->nullable()->references('PartID')->on('parts')->onDelete('cascade');
            $table->foreignId('FKosId')->nullable()->references('PartID')->on('parts')->onDelete('cascade');
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
        Schema::dropIfExists('my_pcs');
    }
};
