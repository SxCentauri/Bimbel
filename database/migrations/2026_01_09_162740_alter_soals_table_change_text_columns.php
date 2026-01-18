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
        Schema::table('soals', function (Blueprint $table) {
            $table->longText('pertanyaan')->change();
            $table->longText('opsi_a')->change();
            $table->longText('opsi_b')->change();
            $table->longText('opsi_c')->change();
            $table->longText('opsi_d')->change();
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('soals', function (Blueprint $table) {
            $table->string('pertanyaan', 255)->change();
            $table->string('opsi_a', 255)->change();
            $table->string('opsi_b', 255)->change();
            $table->string('opsi_c', 255)->change();
            $table->string('opsi_d', 255)->change();
        });
    }
};
