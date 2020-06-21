<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('return_id','50')->nullable();
            $table->string('API_KEY',50)->nullable();
            $table->boolean('sandbox')->default(0)->nullable();
            $table->string('name',50)->nullable();
            $table->string('phone',12)->nullable();
            $table->string('mail',100)->nullable();
            $table->string('amount',10)->nullable();
            $table->bigInteger('reseller')->nullable();
            $table->string('status',10)->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
