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
        DB::statement(
/** @lang text */
<<<'SQL'
create table templates
(
	id int identity
		primary key,
	page_id int default '1' not null,
	base_van int not null,
	visibility bit default '1' not null,
	name nvarchar(150) default 'Title' not null,
	template nvarchar(4000) not null,
	[order] int not null,
	created_at datetime2,
	updated_at datetime2,
	sales_drawing bit constraint DF_templates_sales_drawing default 1 not null,
	production_drawing bit constraint DF_templates_production_drawing default 0 not null,
	pdf bit constraint DF_templates_pdf default 0 not null
)

create index templates_id_index
	on templates (id)

create table template_options
(
	id int identity
		constraint PK_template_options
			primary key,
	template_id int not null,
	option_id int not null
)


create table renders
(
	id int identity
		primary key,
	blueprint_id int not null,
	template_id int not null,
	created_at datetime2,
	updated_at datetime2,
	production_drawing bit,
	sales_drawing bit
)

create table questions
(
	id int identity
		primary key,
	_lft int default '0' not null,
	_rgt int default '0' not null,
	parent_id int,
	question nvarchar(100) not null,
	layout_id int,
	category varchar(50),
	visible bit constraint DF_questions_visible default 1 not null
)

create index questions__lft__rgt_parent_id_index
	on questions (_lft, _rgt, parent_id)

	create table purchase_requests
(
	id int identity
		primary key,
	user_id int not null,
	part_number nvarchar(50),
	description nvarchar(1000) not null,
	quantity float default '1' not null,
	unit_of_measure nvarchar(255) default 'EA' not null,
	job nvarchar(50),
	urgency int default '5' not null,
	notes nvarchar(1000),
	ordered bit default '0' not null,
	created_at datetime2,
	updated_at datetime2,
	status int default '5' not null,
	supplier_name nvarchar(50),
	purchase_order nvarchar(50),
	stock bit
)


create table layout_options
(
	id int identity
		primary key,
	layout_id int not null,
	option_id int not null,
	x_pos float default '0' not null,
	y_pos float default '0' not null,
	qty float default '1' not null,
	created_at datetime2,
	updated_at datetime2
)


create index layout_options_id_index
	on layout_options (id)


create table layouts
(
	id int identity
		primary key,
	base_van_id int not null,
	visibility bit default '1' not null,
	name nvarchar(150) default 'Title' not null,
	notes nvarchar(4000),
	created_at datetime2,
	updated_at datetime2
)


create index layouts_id_index
	on layouts (id)


create table light_pods
(
	id int identity,
	blueprint_id int not null,
	data nvarchar(max),
	instructions nvarchar(max)
)
















create table blueprint_sessions
(
	id nvarchar(100) not null,
	user_id int,
	ip_address nvarchar(45),
	user_agent text,
	payload text not null,
	last_activity int
)


create unique index blueprint_sessions_id_uindex
	on blueprint_sessions (id)


create table bug_report_activities
(
	id int identity
		constraint bug_report_activities_pk
			primary key nonclustered,
	bug_report_id int not null,
	assigned_user_id int not null,
	sequence int default 0 not null,
	title nvarchar(100) not null,
	created_at datetime2,
	updated_at datetime2,
	assigned_at datetime2,
	due_at datetime2,
	notes nvarchar(255),
	user_id int not null,
	completed bit default 0 not null,
	due_date date
)


create unique index bug_report_activities_id_uindex
	on bug_report_activities (id)


create table bug_reports
(
	id int identity,
	created_at datetime2 not null,
	updated_at datetime2 not null,
	user_id int not null,
	related_id int,
	title nvarchar(100) not null,
	type nvarchar(50),
	browser nvarchar(50),
	full_version nvarchar(50),
	major_version nvarchar(50),
	app_name nvarchar(150),
	user_agent nvarchar(150),
	os nvarchar(50),
	user_notes text,
	dev_notes text,
	status nvarchar(50) constraint DF_bug_reports_status default N'Unresolved' not null,
	urgency int constraint DF_bug_reports_urgency default 5 not null,
	program nvarchar(50) constraint DF_bug_reports_program default N'Blueprint' not null,
	related_table nvarchar(50),
	url text,
	assigned_user_id int,
	engineering_task bit default 0 not null,
	due_date date,
	file_locations text,
	priority as case when [due_date] IS NULL then 7 when datediff(day,getdate(),[due_date])<=0 then 10*[urgency] when datediff(day,getdate(),[due_date])>=90 then [urgency] else [urgency]/power(CONVERT([float],0.1),CONVERT([float],90-datediff(day,getdate(),[due_date]))/90) end
)


create table cache
(
	[key] nvarchar(255) not null,
	value text not null,
	expiration int not null,
	id int identity
)

create table components
(
	id int identity
		primary key,
	option_id int not null,
	component_sub_assembly nvarchar(255),
	component_stock_code nvarchar(255),
	component_description nvarchar(255),
	component_part_category nvarchar(255),
	component_material_qty nvarchar(255),
	component_material_cost float default '0',
	component_unit_of_measure nvarchar(6) default 'EA',
	component_revision nvarchar(255) default '1',
	component_item_code nvarchar(255),
	component_where_built_location nvarchar(255),
	component_install_area nvarchar(255),
	component_notes nvarchar(4000),
	labour_cost float default '24' not null,
	component_long_description nvarchar(255),
	created_at datetime2,
	updated_at datetime2,
	component_labour_cost float,
	component_price_category nchar(10) constraint DF_components_component_price_category default N'E' not null
)


create index components_id_index
	on components (id)


create index components_option_id_index
	on components (option_id)

create table configurations
(
	id int identity
		primary key,
	blueprint_id int not null,
	name nvarchar(15) not null,
	description nvarchar(100),
	base_van_id int default '1' not null,
	syspro_phantom nvarchar(30),
	cost float default '0' not null,
	price_tier_1 float default '0' not null,
	price_tier_2 float default '0' not null,
	price_tier_3 float default '0' not null,
	value bit default '0' not null,
	positive_requirements nvarchar(255),
	negative_requirements nvarchar(255),
	long_lead_time bit default '0' not null,
	show_on_quote bit default '1' not null,
	light_component bit default '0' not null,
	locked bit default '0' not null,
	location int default '0' not null,
	option_id int,
	fingerprint nvarchar(256),
	quantity int default '1' not null,
	created_at datetime2,
	updated_at datetime2,
	price_base_offset float constraint DF_configurations_price_base_offset default 0 not null,
	price_dealer_offset float constraint DF_configurations_price_dealer_offset default 0 not null,
	price_msrp_offset float constraint DF_configurations_price_msrp_offset default 0 not null,
	notes nvarchar(100),
	retired bit default '0' not null,
	revision int default 0,
	obsolete bit default 0
)

create table contacts
(
	id int identity
		primary key,
	name nvarchar(255),
	title nvarchar(255),
	company nvarchar(255) not null,
	contact_type nvarchar(255) not null,
	name_token nvarchar(255) not null,
	address_1 nvarchar(255),
	address_2 nvarchar(255),
	city nvarchar(15),
	province nvarchar(15),
	country nvarchar(12),
	postal_code nvarchar(11),
	phone nvarchar(255),
	cell nvarchar(255),
	fax nvarchar(255),
	email nvarchar(255),
	created_at datetime2,
	updated_at datetime2
)


create index contacts_id_index
	on contacts (id)

create table departments
(
	id int identity,
	name nvarchar(50) not null,
	colour nvarchar(7) constraint DF_departments_colour default '#ffffff' not null
)

create table documents
(
	id int identity,
	_lft int not null,
	_rgt int not null,
	parent_id int,
	name nvarchar(255) not null,
	media_id int,
	visible bit constraint DF_documents_visible default 1 not null,
	category nvarchar(50)
)



create table fleet_audits
(
	id int identity
		primary key,
	user_id int not null,
	case_name_1 nvarchar(255) default 'Option A' not null,
	case_name_2 nvarchar(255) default 'Option B' not null,
	purchase_price_1 int default '0' not null,
	purchase_price_2 int default '0' not null,
	curb_weight_1 int default '1000' not null,
	curb_weight_2 int default '1000' not null,
	mileage int default '1000' not null,
	metric bit default '0' not null,
	fleet_size int default '1' not null,
	gas_price float default '1' not null,
	years_in_service int constraint DF_fleet_audits_years_in_service default 1 not null,
	cargo_weight int constraint DF_fleet_audits_weight default 1 not null,
	created_at datetime2,
	updated_at datetime2,
	chassis_1_weight_lb int constraint DF_fleet_audits_chassis_1_weight default 1 not null,
	chassis_2_weight_lb int constraint DF_fleet_audits_chassis_2_weight_lb default 1 not null,
	chassis_1_mpg float constraint DF_fleet_audits_chassis_1_mpg default 1 not null,
	chassis_2_mpg float constraint DF_fleet_audits_chassis_2_mpg default 1 not null
)

create table folders
(
	id int identity,
	_lft int not null,
	_rgt int not null,
	parent_id int,
	name nvarchar(50) not null
)

create table inventory
(
	id int identity
		constraint inventory_count_pk
			primary key nonclustered,
	description nvarchar(250) not null,
	user_id int,
	created_at datetime2,
	updated_at datetime2,
	locked bit default 0
)


create unique index inventory_count_id_uindex
	on inventory (id)


create table inventory_item_counts
(
	id int identity
		constraint inventory_item_counts_pk
			primary key nonclustered,
	user_id int,
	created_at datetime2,
	updated_at datetime2,
	inventory_item_id int,
	counted decimal(10,3),
	counter_name nvarchar(100),
	accepted bit default 0,
	recounted bit default 0
)


create unique index inventory_item_counts_id_uindex
	on inventory_item_counts (id)


create table inventory_items
(
	id int identity
		constraint inventory_count_items_pk
			primary key nonclustered,
	stock_code nvarchar(30) not null,
	description_1 nvarchar(100) not null,
	description_2 nvarchar(100),
	bin nvarchar(20),
	[group] nvarchar(20),
	created_at datetime2,
	updated_at datetime2,
	unit_of_measure nvarchar(20),
	expected_quantity decimal(10,5) not null,
	locked bit default 0,
	inventory_id int,
	cost numeric(18,5),
	locale nvarchar(40),
	warehouse nvarchar(40),
	last_issued_date datetime,
	supplier nvarchar(20),
	manually_added int default 0,
	ticket_number int default 1
)


create unique index inventory_count_items_id_uindex
	on inventory_items (id)





SQL);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('templates');
        Schema::dropIfExists('template_options');
        Schema::dropIfExists('renders');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('purchase_requests');
        Schema::dropIfExists('layouts');
        Schema::dropIfExists('layout_options');
        Schema::dropIfExists('light_pods');

        Schema::dropIfExists('inventory');
        Schema::dropIfExists('fleet_audits');
        Schema::dropIfExists('failed_jobs');
        Schema::dropIfExists('departments');
        Schema::dropIfExists('contacts');
        Schema::dropIfExists('configurations');
        Schema::dropIfExists('components');
        Schema::dropIfExists('blueprint_sessions');
        Schema::dropIfExists('bug_report_activities');
        Schema::dropIfExists('bug_reports');
        Schema::dropIfExists('cache');
        Schema::dropIfExists('documents');
        Schema::dropIfExists('folders');
        Schema::dropIfExists('inventory_item_counts');
        Schema::dropIfExists('inventory_items');
    }
};
