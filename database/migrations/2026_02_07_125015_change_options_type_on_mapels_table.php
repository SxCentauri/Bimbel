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
        Schema::table('mapels', function (Blueprint $table) {
        $table->text('a')->change();
        $table->text('b')->change();
        $table->text('c')->change();
        $table->text('d')->change();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mapels', function (Blueprint $table) {
        $table->string('a')->change();
        $table->string('b')->change();
        $table->string('c')->change();
        $table->string('d')->change();
    });
    }
};
