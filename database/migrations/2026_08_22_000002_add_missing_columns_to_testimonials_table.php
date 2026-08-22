<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            if (!Schema::hasColumn('testimonials', 'order')) {
                $table->integer('order')->default(0)->after('rating');
            }
            if (!Schema::hasColumn('testimonials', 'designation')) {
                $table->string('designation')->nullable()->after('client_name');
            }
            if (!Schema::hasColumn('testimonials', 'is_active')) {
                $table->boolean('is_active')->default(true);
            }
        });
    }

    public function down(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            if (Schema::hasColumn('testimonials', 'order')) {
                $table->dropColumn('order');
            }
            if (Schema::hasColumn('testimonials', 'designation')) {
                $table->dropColumn('designation');
            }
            if (Schema::hasColumn('testimonials', 'is_active')) {
                $table->dropColumn('is_active');
            }
        });
    }
};
