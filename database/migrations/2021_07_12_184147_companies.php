<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Companies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('companies', function (Blueprint $table) {
                $table->id();
                $table->string('name', 255);
                $table->string('address_1', 255)->nullable();
                $table->string('address_2', 255)->nullable();
                $table->string('address_3', 255)->nullable();
                $table->string('city',50)->nullable();
                $table->string('province',50)->nullable();
                $table->string('country', 255)->nullable();
                $table->string('postalcode', 10)->nullable();
                $table->string('phone', 255)->nullable();
                $table->string('fax', 255)->nullable();
                $table->string('website', 255)->nullable();
                $table->string('logo', 255)->nullable();
                $table->string('service_address_1', 255)->nullable();
                $table->string('service_address_2', 255)->nullable();
                $table->string('service_address_3', 255)->nullable();
                $table->string('service_city', 20)->nullable();
                $table->string('service_province', 20)->nullable();
                $table->string('service_country', 20)->nullable();
                $table->string('service_postalcode', 10)->nullable();
                $table->string('service_phone', 255)->nullable();
                $table->string('service_fax', 255)->nullable();
                $table->string('service_manager', 40)->nullable();
                $table->string('service_email', 255)->nullable();
                $table->string('service_technicians', 255)->nullable();
                $table->string('service_hours', 255)->nullable();
                $table->string('service_emergency', 255)->nullable();
                $table->string('service_capabilities', 1000)->nullable();
                $table->string('service_other', 1000)->nullable();
                $table->datetime('created_at', 2)->nullable();
                $table->datetime('updated_at', 2)->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            Schema::dropIfExists('companies');
        });
    }
}
