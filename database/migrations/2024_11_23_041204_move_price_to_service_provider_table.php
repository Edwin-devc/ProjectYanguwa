<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Remove the price column from the pivot table
        Schema::table('service_provider_service', function (Blueprint $table) {
            $table->dropColumn('price');
        });

        // Add the price column to the service_providers table
        Schema::table('service_providers', function (Blueprint $table) {
            $table->integer('price')->after('bio'); // Adjust the column order as needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Add the price column back to the pivot table
        Schema::table('service_provider_service', function (Blueprint $table) {
            $table->decimal('price', 8, 2)->nullable();
        });

        // Remove the price column from the service_providers table
        Schema::table('service_providers', function (Blueprint $table) {
            $table->dropColumn('price');
        });
    }
};
