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
        DB::statement(/** @lang text */
<<<'ALBUMS'
    create table albums
    (
        id int identity,
        _lft int not null,
        _rgt int not null,
        parent_id int,
        name nvarchar(50) not null,
        [public] bit constraint DF_albums_public default 0 not null,
        search_string ntext
    )
ALBUMS
);

        DB::statement(
/** @lang text */
<<<'ANNOUNCEMENTS'
    create table announcements
    (
        id int identity
            constraint announcements_pk
        content text not null,
        start_date date,
        end_date date,
        created_at datetime2,
        updated_at datetime2,
        user_id int not null,
        media_id int
    )


ANNOUNCEMENTS
    );

        DB::statement(
/** @lang text */
<<<'AUDITS'

      create table audits
        (
            id int identity
            primary key,
        user_id int,
        event nvarchar(255) not null,
        auditable_id int not null,
        auditable_type nvarchar(255) not null,
        old_values nvarchar(max),
        new_values nvarchar(max),
        url nvarchar(max),
        ip_address nvarchar(45),
        user_agent nvarchar(255),
        tags nvarchar(255),
        created_at datetime,
        updated_at datetime
    )
AUDITS
    );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('albums');
        Schema::dropIfExists('announcements');
        Schema::dropIfExists('audits');
    }
};
