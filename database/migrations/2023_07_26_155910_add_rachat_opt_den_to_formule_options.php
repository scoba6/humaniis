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
        Schema::table('formule_options', function (Blueprint $table) {
            $table->float('mntopx')->nullable()->default(0)->after('mnteur');
            $table->float('mntope')->nullable()->default(0)->after('mntopx');
            $table->float('mntdnx')->nullable()->default(0)->after('mntope');
            $table->float('mntdne')->nullable()->default(0)->after('mntdnx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('formule_options', function (Blueprint $table) {
            //
        });
    }
};
