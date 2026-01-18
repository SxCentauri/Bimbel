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
            $table->longText('pertanyaan')->change();
            $table->longText('a')->change();
            $table->longText('b')->change();
            $table->longText('c')->change();
            $table->longText('d')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mapels', function (Blueprint $table) {
            $table->text('pertanyaan')->change();
            $table->string('a')->change();
            $table->string('b')->change();
            $table->string('c')->change();
            $table->string('d')->change();
    });
    }
};
