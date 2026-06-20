<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    /* public function up(): void
    {
        Schema::create('book_genre', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    } */


    public function up(): void
    {
        /* Schema::create('book_genre', function (Blueprint $table) {
            $table->id();

            $table->foreignId('book_id')
                ->constrained('books')
                ->onDelete('cascade');

            $table->foreignId('genre_id')
                ->constrained('genres')
                ->onDelete('cascade');

            $table->timestamps();
        }); */
        Schema::create('book_genre', function(Blueprint $table){

            $table->foreignId('book_fk')->constrained(table:'books', column:'id');
            //$table->unsignedBigInteger('genre_fk');
                    
            $table->unsignedBigInteger('genre_fk');
            $table->foreign('genre_fk')->references('id')->on('genres');//Esto por que en plural?????
            $table->primary(['book_fk','genre_fk']);
            $table->timestamps();

        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_genre');
    }
};
