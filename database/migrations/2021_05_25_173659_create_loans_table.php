<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->nullable(false);
            $table->timestamp('request_date')->nullable(false);
            $table->integer('request_amount')->nullable(false);
            $table->integer('term')->nullable(false);
            $table->integer('approved_amount')->nullable(false)->default(0);
            $table->integer('status')->nullable(false)->default(0);
            $table->integer('approved_by')->nullable()->default(null);
            $table->string('user_remarks')->nullable()->default(null);
            $table->string('manager_remarks')->nullable()->default(null);
            $table->timestamp('approved_date')->nullable(true)->default(null);
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
        Schema::dropIfExists('loans');
    }
}
