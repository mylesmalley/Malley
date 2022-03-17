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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 255);
            $table->string('last_name', 255);
            $table->string('email', 255)->unique();
            $table->string('password', 255);
            $table->integer('company_id')->default(0);
            //       $table->string('role', 15)->default('distributor');
            $table->datetime('created_at', 2);
            $table->datetime('updated_at', 2);

            $table->boolean('is_administrator')->default(0);
            $table->boolean('can_create_template')->default(0);
            $table->boolean('can_create_quote')->default(0);
            $table->boolean('can_upload_file')->default(0);
            $table->boolean('can_delete_file')->default(0);
            $table->boolean('is_enabled')->default(0);
            $table->boolean('can_edit_options')->default(0);
            $table->boolean('can_edit_forms')->default(0);
            $table->boolean('is_admin')->default(0);
            $table->boolean('email_when_user_created')->default(0);
            $table->boolean('email_when_blueprint_created')->default(0);
            $table->boolean('quote_permission_level')->default(0);
            $table->string('temp_data', 100)->nullable();
            $table->boolean('email_when_warranty_registered')->default(0);

            $table->boolean('mobility_access')->default(0);
            $table->boolean('ambulance_access')->default(0);
            $table->boolean('plastics_access')->default(0);
            $table->boolean('show_blueprint_options')->default(0);
            $table->boolean('show_question_tree')->default(0);
            $table->boolean('show_option_pricing_in_index')->default(0);

            $table->boolean('show_image_count_in_index')->default(0);
            $table->boolean('email_when_quote_requested')->default(0);
            $table->boolean('blank_access')->default(0);
            $table->boolean('show_sales_in_index')->default(0);
            $table->boolean('pricing_mode')->default(0);

            $table->boolean('demo_mode')->default(0);

            $table->integer('department_id')->default(1);

            $table->boolean('can_edit_purchase_requests')->default(0);
            $table->boolean('vdb_modify_dates')->default(0);
            $table->boolean('vdb_modify_inspections')->default(0);
            $table->boolean('vdb_modify_files')->default(0);
            $table->boolean('vdb_modify_photos')->default(0);
            $table->boolean('vdb_modify_info')->default(0);
            $table->boolean('email_when_warranty_submitted')->default(0);
            $table->boolean('vbd_modify_documents')->default(0);
            $table->boolean('vbd_modify_finance')->default(0);
            $table->boolean('vdb_work_orders')->default(0);
            $table->boolean('email_when_requesting_incomplete_options')->default(0);
            $table->boolean('bug_report_assignable')->default(0);
            $table->boolean('bug_report_editor')->default(0);
            $table->boolean('index_show_id_column')->default(0);
            $table->boolean('index_show_obsolete_options')->default(0);
            $table->boolean('index_show_blueprint_only_options')->default(0);
            $table->boolean('index_show_phantom_column')->default(0);
            $table->boolean('index_show_tags_column')->default(0);
            $table->boolean('index_show_errors_column')->default(0);
            $table->boolean('inventory_admin')->default(0);
            $table->boolean('vdb_work_order_from_warranty_claim')->default(0);
            $table->boolean('index_show_pricing_columns')->default(0);
            $table->text('preferences')->default('{}');

            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
