<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('package_id');
            $table->string('country_id');
            $table->string('number_of_packages')->nullable();
            $table->string('number_of_users')->nullable();;
            $table->string('charge_per_user')->nullable();;
            $table->string('charge_per_package')->nullable();;
            $table->string('subtotal')->nullable();;
            $table->string('total')->nullable();;
            $table->string('taxes')->nullable();;
            $table->string('delivery')->nullable();;
            $table->boolean('use_the_payment_method_on_file')->nullable();;
            $table->string('description')->nullable();;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
