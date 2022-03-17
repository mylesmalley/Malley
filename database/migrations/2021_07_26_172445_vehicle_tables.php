<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        DB::statement(
/** @lang text */
<<<'SQL'
    create table tags
    (
        id int identity
            constraint tags_pk
                primary key nonclustered,
        name nvarchar(50),
        base_van_id int,
        model nvarchar(20) default 'option'
    )


    create table vehicle_albums
    (
        id bigint identity
            primary key,
        vehicle_id int not null,
        album_id int not null
    )

    create table vehicle_contact
    (
        vehicle_id int not null,
        contact_id int not null,
        created_at datetime,
        updated_at datetime
    )


    create table vehicle_tags
    (
        id int identity
            constraint vehicle_tags_pk
                primary key nonclustered,
        vehicle_id int not null,
        tag_id int not null
    )


    create table warranty_claims
    (
        id int identity,
        first_name nvarchar(50) not null,
        last_name nvarchar(50) not null,
        phone nvarchar(20) not null,
        email nvarchar(100) not null,
        organization nvarchar(50),
        make nvarchar(25) not null,
        model nvarchar(25) not null,
        year int not null,
        mileage int not null,
        vin nvarchar(20) not null,
        date nvarchar(50) not null,
        issue nvarchar(2000) not null,
        pin nvarchar(10) not null,
        created_at datetime2,
        updated_at datetime2,
        vehicle_id int,
        notes text
    )


    create table work_order_lines
    (
        id int identity
            constraint work_order_lines_pk
                primary key nonclustered,
        work_order_id int not null,
        [order] int,
        description nvarchar(1000),
        part_number nvarchar(30),
        quantity int,
        created_at datetime2,
        updated_at datetime2
    )


    create unique index work_order_lines_id_uindex
        on work_order_lines (id)

    create table work_orders
    (
        id int identity
            primary key,
        vehicle_id int,
        user_id int,
        number nvarchar(30),
        created_at datetime2,
        updated_at datetime2,
        warranty_claim_id int,
        odometer int default 0,
        date date,
        title nvarchar(100) default 'Work Order',
        purchase_order_number nvarchar(50),
        quote_number nvarchar(50),
        expected_chassis_delivery_date date,
        expected_customer_pickup_date date,
        customer_address_1 nvarchar(100),
        customer_address_2 nvarchar(100),
        customer_city nvarchar(50),
        customer_province nvarchar(50),
        customer_postalcode nvarchar(20),
        customer_email nvarchar(100),
        customer_phone nvarchar(20),
        customer_contact nvarchar(50),
        customer_name nvarchar(100),
        type nvarchar(10),
        linecount int
    )


SQL);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
        Schema::dropIfExists('work_orders');
        Schema::dropIfExists('work_order_lines');
        Schema::dropIfExists('warranty_claims');
        Schema::dropIfExists('vehicle_albums');
        Schema::dropIfExists('vehicle_contact');
        Schema::dropIfExists('vehicle_tags');
    }
};
