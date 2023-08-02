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
        Schema::create('formule_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('formule_id')->constrained('formules');
            $table->string('libopt')->default('OPTIONS')->nullable(false);
            $table->integer('agemin')->unsigned()->nullable(false)->default(0);
            $table->integer('agemax')->unsigned()->nullable(false)->default(0);
            $table->foreignId('sexgrp_id')->constrained('sexgrp')->default(1);
            $table->float('mntxaf')->default(0)->nullable(false);
            $table->float('mnteur')->default(0)->nullable(false);
            $table->string('dtlopt')->default('DETAILS')->nullable();
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
        Schema::dropIfExists('formule_options');
    }
};
