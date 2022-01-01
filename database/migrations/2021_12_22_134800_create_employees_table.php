<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('position_id')->constrained();
            $table->unsignedBigInteger('head_id')->nullable();
            $table->foreign('head_id')->references('id')->on('employees');
            $table->tinyInteger('level')->default(1);
            $table->date('employment_at');
            $table->string('phone');
            $table->string('email');
            $table->integer('salary');
            $table->string('photo')->nullable();
            $table->integer('admin_created_id')->default(1);
            $table->integer('admin_updated_id')->default(1);
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
        Schema::dropIfExists('employees');
    }
}
