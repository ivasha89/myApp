<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slbs', function (Blueprint $table) {
            $table->char('idbr', 16);
            $table->char('date', 16);
            $table->char('slba', 8);
            $table->char('stts', 8);
            $table->increments('ind');
            $table->engine='InnoDB';
            $table->charset='Utf8mb4';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slbs');
    }
}
