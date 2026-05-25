<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('requests', function (Blueprint $table) {
            $table->enum('service', ['website', 'web app', 'mobile app', 'consulting', 'tool', 'IT', 'other'])->default('other');
            $table->enum('tool', ['park', 'plan review', 'other'])->default('other');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('requests', function (Blueprint $table) {
            $table->dropColumn('service');
            $table->dropColumn('tool');
        });
    }
};