<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateDetailBookBorrowingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_book_borrowing', function (Blueprint $table) {
            $table->bigIncrements('id_detail_book_borrowing');
            $table->integer('qty');
            $table->unsignedBigInteger('id_book_borrowing');
            $table->unsignedBigInteger('id_book');

            $table->foreign('id_book_borrowing')->references('id_book_borrowing')->on('book_borrowing');
            $table->foreign('id_book')->references('id_book')->on('book');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_book_borrowing');
    }
}