<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('famille_membres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('famille_id')->constrained('familles')->default(0);
            $table->foreignId('qualite_id')->constrained('qualites')->default(0);
            $table->foreignId('formule_id')->constrained('formules')->default(0);
            $table->foreignId('option_id')->constrained('formule_options')->default(1);
            $table->foreignId('sexmem_id')->constrained('sexgrp');
            $table->string('nommem')->default('')->nullable(false);
            $table->string('matmem')->default('')->nullable(false);
            $table->date('datnai')->nullable(false);
            $table->integer('agemem')->nullable(false);
            $table->date('valfrm')->nullable(false)->default(now());
            $table->string('commem')->default('')->nullable(); //Commentaire
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('famille_membres');
    }
};
