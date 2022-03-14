<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookReturnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_return', function (Blueprint $table) {
            $table->bigIncrements('id_book_return');
            $table->unsignedBigInteger('id_book_borrowing');
            $table->date('return_date');
            $table->integer('amercement');

            $table->foreign('id_book_borrowing')->references('id_book_borrowing')->on('book_borrowing');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_return');
    }
}
