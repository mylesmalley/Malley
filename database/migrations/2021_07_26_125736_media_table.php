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
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->integer('model_id');
            $table->string('collection_name', 255);
            $table->string('name', 255);
            $table->string('file_name', 255);
            $table->string('mime_type', 255)->nullable();
            $table->string('disk', 255);
            $table->integer('size');
            $table->text('manipulations');
            $table->text('custom_properties');
            $table->integer('order_column');
            $table->datetime('created_at', 2);
            $table->datetime('updated_at', 2);
            $table->string('model_type', 255);
            $table->integer('base_van_id')->nullable();
            $table->string('option_name', 50)->nullable();
            $table->text('responsive_images');
            $table->text('generated_conversions');
            $table->uuid('uuid');
            $table->string('conversions_disk', 255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('media');
    }
};
