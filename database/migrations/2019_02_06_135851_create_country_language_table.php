<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountryLanguageTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('country_language', function (Blueprint $table) {
            $table->increments('id');
            $table->string('country_code');
            $table->string('language_code');
            $table->timestamps();

            $table->foreign('country_code')->references('code')->on('countries')->onDelete('cascade');
            $table->foreign('language_code')->references('code')->on('languages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('country_language');
    }
}
