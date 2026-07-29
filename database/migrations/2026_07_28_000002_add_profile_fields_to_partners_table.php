<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('partners', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('name');
            $table->text('description')->nullable()->after('logo');
            $table->string('address')->nullable()->after('description');
            $table->json('projects')->nullable()->after('address');
            $table->json('products')->nullable()->after('projects');
            $table->string('clients_count')->nullable()->after('products');
            $table->string('employees_count')->nullable()->after('clients_count');
        });

        DB::table('partners')->whereNull('slug')->orderBy('id')->get(['id', 'name'])->each(function ($partner) {
            $base = Str::slug($partner->name) ?: 'partner';
            $slug = $base;
            $i = 1;

            while (DB::table('partners')->where('slug', $slug)->where('id', '!=', $partner->id)->exists()) {
                $slug = "{$base}-{$i}";
                $i++;
            }

            DB::table('partners')->where('id', $partner->id)->update(['slug' => $slug]);
        });
    }

    public function down(): void
    {
        Schema::table('partners', function (Blueprint $table) {
            $table->dropColumn(['slug', 'description', 'address', 'projects', 'products', 'clients_count', 'employees_count']);
        });
    }
};
