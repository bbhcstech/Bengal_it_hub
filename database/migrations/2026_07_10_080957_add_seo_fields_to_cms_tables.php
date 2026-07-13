<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $tables = ['pages', 'services', 'events', 'blog_posts'];

    public function up(): void
    {
        foreach ($this->tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->string('meta_keywords')->nullable()->after('meta_description');
                $table->string('meta_robots')->default('index, follow')->after('meta_keywords');
            });
        }
    }

    public function down(): void
    {
        foreach ($this->tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->dropColumn(['meta_keywords', 'meta_robots']);
            });
        }
    }
};
