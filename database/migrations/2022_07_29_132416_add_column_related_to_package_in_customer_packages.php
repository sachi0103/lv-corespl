<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnRelatedToPackageInCustomerPackages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_packages', function (Blueprint $table) {
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('number_of_selected_package')->nullable();
            $table->unsignedBigInteger('number_of_selected_user')->nullable();
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_packages', function (Blueprint $table) {
            $table->dropColumn('country_id');
            $table->dropColumn('number_of_selected_package');
            $table->dropColumn('number_of_selected_user');
            $table->dropColumn('description');
        });
    }
}
