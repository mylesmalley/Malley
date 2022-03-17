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
        DB::statement(/** @lang text */ "
        create table blueprints
(
    id                  int identity
        primary key,
    name                nvarchar(255)                           not null,
    description         nvarchar(255),
    customer_name       nvarchar(255),
    user_id             int                                     not null,
    base_van_id         int   default '1'                       not null,
    customer_address_1  nvarchar(255),
    customer_address_2  nvarchar(255),
    customer_address_3  nvarchar(255),
    customer_city       nvarchar(20),
    customer_province   nvarchar(20),
    customer_country    nvarchar(20),
    customer_postalcode nvarchar(10),
    customer_phone      nvarchar(255),
    customer_fax        nvarchar(255),
    customer_website    nvarchar(255),
    customer_logo       nvarchar(255),
    status              int   default '0'                       not null,
    number              nvarchar(12),
    notes               nvarchar(4000),
    currency            nvarchar(3)
        constraint DF__blueprint__curre__6D8D2138 default 'CAD' not null,
    exchange_rate       float default '1'                       not null,
    is_locked           bit
        constraint DF_blueprints_is_locked default 0            not null,
    has_custom_layout   bit
        constraint has_custom_layout_def default 0,
    custom_layout       varchar(2000),
    created_at          datetime2,
    updated_at          datetime2,
    layout_id           int,
    quotes_visible      bit
        constraint DF_blueprints_quotes_visible default 0       not null,
    renders_visible     bit
        constraint DF_blueprints_renders_visible default 1      not null,
    terms               int
        constraint DF_blueprints_terms default 0                not null,
    quote_number        nvarchar(50),
    customer_email      nvarchar(50)
)
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blueprints');
    }
};
