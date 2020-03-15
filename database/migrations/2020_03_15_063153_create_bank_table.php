<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('institusi_id');
            $table->string('name');
            $table->string('no_rek');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('institusi_id', 'bank_institusi_id_foreign')
                ->references('id')->on('institusi')
                ->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank');
    }
}
