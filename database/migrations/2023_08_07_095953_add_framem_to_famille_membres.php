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
        Schema::table('famille_membres', function (Blueprint $table) {
            $table->boolean('framem')->nullable()->default(false)->after('valfrm');
            $table->boolean('optmem')->nullable()->default(false)->after('framem');
            $table->boolean('denmem')->nullable()->default(false)->after('optmem');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('famille_membres', function (Blueprint $table) {
            //
        });
    }
};
