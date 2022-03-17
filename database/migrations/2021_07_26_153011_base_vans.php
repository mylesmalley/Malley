<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BaseVans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement(
/** @lang text */ <<<'STMNT'
    create table base_vans
    (
        id int identity
            primary key,
        name nvarchar(30) not null,
        visibility bit default '0' not null,
        created_at datetime2,
        updated_at datetime2,
        option_prefix nvarchar(3),
        categories nvarchar(max) constraint DF_base_vans_categories default '{}' not null
    )

STMNT

        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('base_vans');
    }
}
