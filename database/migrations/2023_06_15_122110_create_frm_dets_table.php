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
        Schema::create('formules_details', function (Blueprint $table) {
            $table->id();
            $table->integer('sexdet')->default(1)->nullable(false);
            $table->integer('ageinf')->default(0)->nullable(false);
            $table->integer('agemax')->default(0)->nullable(false);
            $table->float('mntxaf')->default(0)->nullable(false);
            $table->float('mnteur')->default(0)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formules_details');
    }
};
