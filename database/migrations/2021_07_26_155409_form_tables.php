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
        DB::statement(
/** @lang text */
<<<'FORM'


            create table forms
        (
            id int identity,
        base_van_id int not null,
        name nvarchar(50) not null,
        visibility bit constraint DF_forms_visibility default 0 not null,
        created_at datetime2,
        updated_at datetime2,
        [order] int constraint DF_forms_order default 0 not null,
        standard_blueprint_form bit constraint DF_forms_standard_blueprint_form default 1 not null,
        form_type nvarchar(20) constraint DF_forms_form_type default N'standard' not null
    )


                create table form_elements
        (
            id int identity,
        form_id int not null,
        type varchar(15) constraint DF_form_elements_type default 'selection' not null,
        label nvarchar(50),
        created_at datetime2,
        updated_at datetime2,
        position int,
        option_id_requirement nvarchar(50),
        indent int default 0,
        comments nvarchar(250)
    )


            create table form_element_items
        (
            id int identity
            constraint PK_form_element_item
                primary key,
        form_element_id int not null,
        option_id int,
        media_id int,
        created_at datetime2,
        updated_at datetime2,
        position int
    )

    create table form_element_rules
        (
            id int identity,
        form_element_id int not null,
        options nvarchar(255) constraint DF_form_element_rules_options default N'[]',
        operator varchar(50) not null
    )



FORM);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forms');
        Schema::dropIfExists('form_elements');
        Schema::dropIfExists('form_element_items');
        Schema::dropIfExists('form_element_rules');
    }
};
