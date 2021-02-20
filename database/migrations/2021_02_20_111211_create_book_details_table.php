<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_details', function (Blueprint $table) {

            $table->id();
//نویسنده کتاب

            $table->string('writters',300)->nullable();

//            ناشر کتاب
            $table->integer('Publisher_id')->nullable();
//            تاریخ نشر
            $table->dateTimeTz('publication_date', $precision = 0)->nullable();
//            محل نشر
            $table->string('publication_place',100)->nullable();
//            چاپ چندم
            $table->integer('edition')->nullable();
//            ویراست چندم
            $table->integer('edit_version')->nullable();
//تعداد صفحه
            $table->integer('number_of_pages')->nullable();
// نام ترجمه کتاب
            $table->string('Translation',300)->nullable();
// نام مترجم
            $table->string('Translator',300)->nullable();
//منابع کتاب
            $table->string('resources',300)->nullable();
//اتصال به جدول کتاب
            $table->foreignId('book_id')->constrained()->cascadeOnDelete();

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
        Schema::dropIfExists('book_details');
    }
}
