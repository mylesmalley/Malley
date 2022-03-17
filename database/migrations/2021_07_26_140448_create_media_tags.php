<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('media_tags', function (Blueprint $table) {
            $table->id();
            $table->integer('media_id', );
            $table->integer('tag_id', );
        });
    }

    public function down()
    {
        Schema::dropIfExists('media_tags');
    }
};
