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
        <<<'SQL'
    create table options
    (
        id int identity
            primary key,
        option_name nvarchar(15) not null,
        option_description nvarchar(100),
        base_van_id int default '1' not null,
        option_syspro_phantom nvarchar(30),
        option_price_tier_1 float default '0' not null,
        option_price_tier_2 float default '0' not null,
        option_price_tier_3 float default '0' not null,
        option_value bit default '0' not null,
        option_positive_requirements nvarchar(255),
        option_negative_requirements nvarchar(255),
        option_long_lead_time bit default '0' not null,
        option_show_on_quote bit default '1' not null,
        option_short_description nvarchar(25),
        option_light_component bit default '0' not null,
        option_locked bit default '0' not null,
        option_location int default '0' not null,
        fingerprint nvarchar(150),
        option_labour_cost float default '24' not null,
        option_labour_qty float default '0' not null,
        created_at datetime2,
        updated_at datetime2,
        image_path nvarchar(100),
        validated bit constraint DF_options_validated default 0 not null,
        nbems bit constraint DF_options_nbems default 0 not null,
        blueprint_only bit constraint DF_options_blueprint_only default 0 not null,
        option_price_base_offset float constraint DF_options_option_price_base_offset default 0 not null,
        option_price_dealer_offset float constraint DF_options_option_price_dealer_offset default 0 not null,
        option_price_msrp_offset float constraint DF_options_option_price_msrp_offset default 0 not null,
        show_on_pricelist bit constraint DF_options_show_on_pricelist default 1 not null,
        engineering_notes text,
        drawing_notes text,
        blueprint_notes text,
        retired bit default '0' not null,
        no_components bit default 0,
        obsolete bit default 0,
        index_show_phantom_column bit default 0,
        revisionable bit default 0 not null,
        revision int default 1 not null,
        user_id int,
        has_pricing bit default 1,
        show_on_templates bit default 1,
        show_on_forms bit default 1
    )

    create index options_base_van_id_foreign
        on options (base_van_id)

    create table option_rules
    (
        id int identity,
        option_id int not null,
        rule_type nvarchar(50) constraint DF_option_rules_rule_type default N'ALL' not null,
        related_option_id int not null
    )

    create table option_tags
    (
        id int identity
            constraint option_tags_pk
                primary key nonclustered,
        option_id int not null,
        tag_id int not null
    )



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
        Schema::dropIfExists('options');
        Schema::dropIfExists('option_tags');
        Schema::dropIfExists('option_rules');
    }
};
