<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brahs', function (Blueprint $table) {
            $table->string('name', 16);
            $table->string('sname', 32);
            $table->string('tel', 12);
            $table->string('city', 24);
            $table->string('ids', 8)->primary();
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
        Schema::dropIfExists('brahs');
    }
}
