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
        Schema::table('activities', function (Blueprint $table) {
            $table->date('start_at')->nullable()->after('description');
            $table->date('end_at')->nullable()->after('start_at');
            $table->string('location', 150)->nullable()->after('end_at');
            $table->unsignedInteger('capacity')->nullable()->after('location');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn([
                'start_at',
                'end_at',
                'location',
                'capacity',
            ]);
        });
    }
};
