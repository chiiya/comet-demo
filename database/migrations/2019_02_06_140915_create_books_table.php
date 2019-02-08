<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('publisher');
            $table->decimal('price');
            $table->integer('author_id')->unsigned();
            $table->string('country_code');
            $table->string('language_code');
            $table->timestamps();

            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');
            $table->foreign('country_code')->references('code')->on('countries')->onDelete('cascade');
            $table->foreign('language_code')->references('code')->on('languages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
}
