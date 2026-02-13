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
        Schema::table('penduduks', function (Blueprint $table) {
            if (!Schema::hasColumn('penduduks', 'kabupaten_kota')) {
                $table->string('kabupaten_kota')->nullable()->after('pekerjaan');
            }
            if (!Schema::hasColumn('penduduks', 'kecamatan')) {
                $table->string('kecamatan')->nullable()->after('kabupaten_kota');
            }
            if (!Schema::hasColumn('penduduks', 'kelurahan')) {
                $table->string('kelurahan')->nullable()->after('kecamatan');
            }
            if (!Schema::hasColumn('penduduks', 'tempat_lahir_type')) {
                $table->string('tempat_lahir_type')->nullable()->after('tempat_lahir');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penduduks', function (Blueprint $table) {
            if (Schema::hasColumn('penduduks', 'tempat_lahir_type')) {
                $table->dropColumn('tempat_lahir_type');
            }
            if (Schema::hasColumn('penduduks', 'kelurahan')) {
                $table->dropColumn('kelurahan');
            }
            if (Schema::hasColumn('penduduks', 'kecamatan')) {
                $table->dropColumn('kecamatan');
            }
            if (Schema::hasColumn('penduduks', 'kabupaten_kota')) {
                $table->dropColumn('kabupaten_kota');
            }
        });
    }
};
