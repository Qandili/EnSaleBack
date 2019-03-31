<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description');
            $table->double('price');
            $table->boolean('sold');
            $table->string('title');
            $table->string('student');
            $table->integer('categorie')->unsigned();
            $table->foreign('student')->references('student_cne')->on('students')->onDelete('cascade');
            $table->foreign('categorie')->references('categorie_id')->on('categories')->onDelete('cascade');
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
        Schema::dropIfExists('ads');
    }
}
