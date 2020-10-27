<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmploymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employment', function (Blueprint $table) {
            $table->id();
            $table->integer('borrower_id')
                        ->references('id')
                        ->on('borrowers')
                        ->onDelete('cascade');
            $table->string('employeer_name')->nullable();
            $table->decimal('annual_income',9.2)->nullable();
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
        Schema::dropIfExists('employment');
    }
}
