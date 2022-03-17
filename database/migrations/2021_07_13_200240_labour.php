<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labour', function (Blueprint $table) {
            $table->id();
            $table->string('job');
            $table->bigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->integer('department_id')->nullable();
//            $table->foreign('department_id')
//                ->references('id')
//                ->on('departments');

//            $table->dateTimeTz('start', 0);
//            $table->dateTimeTz('end' , 0)
//                ->nullable();

            $table->boolean('flagged')->default(false);
            $table->boolean('posted')->default(false);
        });
        DB::statement(
/** @lang text */
<<<'SQL'
alter table labour
	add [start] datetimeoffset(0),
	  [end] datetimeoffset(0) default null

SQL
);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('labour');
    }
};
