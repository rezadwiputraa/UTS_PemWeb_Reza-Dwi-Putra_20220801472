<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatapelanggansTable extends Migration
{
    public function up()
    {
        Schema::create('datapelanggans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('age')->nullable();
            $table->string('email',)->nullable();
            $table->string('whatsap')->nullable();
            $table->string('description')->nullable();
            $table->string('bookingtime')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
