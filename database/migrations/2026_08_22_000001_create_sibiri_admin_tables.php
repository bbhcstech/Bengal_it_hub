<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('seo_meta')) {
            Schema::create('seo_meta', function (Blueprint $table) {
                $table->id();
                $table->string('page_type')->index();
                $table->unsignedBigInteger('page_id')->nullable();
                $table->string('route_slug')->unique();
                $table->string('title');
                $table->string('meta_description', 500)->nullable();
                $table->string('keywords', 500)->nullable();
                $table->string('canonical_url')->nullable();
                $table->string('og_title')->nullable();
                $table->string('og_description', 500)->nullable();
                $table->string('og_image')->nullable();
                $table->string('robots')->default('index,follow');
                $table->string('schema_type')->default('WebSite');
                $table->timestamps();

                $table->index(['page_type', 'page_id']);
            });
        }

        if (!Schema::hasTable('content_blocks')) {
            Schema::create('content_blocks', function (Blueprint $table) {
                $table->id();
                $table->string('page')->index();
                $table->string('section_key')->index();
                $table->string('label');
                $table->longText('content')->nullable();
                $table->string('type')->default('text');
                $table->integer('order')->default(0);
                $table->timestamps();

                $table->unique(['page', 'section_key']);
            });
        }

        if (!Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('slug')->unique();
                $table->string('tagline')->nullable();
                $table->longText('description')->nullable();
                $table->string('image')->nullable();
                $table->string('external_url')->nullable();
                $table->integer('order')->default(0);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('differentiators')) {
            Schema::create('differentiators', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('description', 500)->nullable();
                $table->string('icon')->nullable();
                $table->integer('order')->default(0);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('process_steps')) {
            Schema::create('process_steps', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('description', 500)->nullable();
                $table->integer('step_number');
                $table->integer('order')->default(0);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('portfolio_projects')) {
            Schema::create('portfolio_projects', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('slug')->unique();
                $table->string('industry')->nullable();
                $table->string('service_tag')->nullable();
                $table->string('thumbnail')->nullable();
                $table->string('outcome_line', 255)->nullable();
                $table->longText('problem')->nullable();
                $table->longText('solution')->nullable();
                $table->longText('result')->nullable();
                $table->integer('order')->default(0);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('team_members')) {
            Schema::create('team_members', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('designation')->nullable();
                $table->string('bio', 500)->nullable();
                $table->string('photo')->nullable();
                $table->string('linkedin_url')->nullable();
                $table->integer('order')->default(0);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('testimonials')) {
            Schema::create('testimonials', function (Blueprint $table) {
                $table->id();
                $table->string('client_name');
                $table->string('designation')->nullable();
                $table->string('company')->nullable();
                $table->text('quote');
                $table->string('photo')->nullable();
                $table->unsignedTinyInteger('rating')->default(5);
                $table->integer('order')->default(0);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('tech_stack')) {
            Schema::create('tech_stack', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('logo')->nullable();
                $table->string('category')->default('backend');
                $table->integer('order')->default(0);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('chatbot_qas')) {
            Schema::create('chatbot_qas', function (Blueprint $table) {
                $table->id();
                $table->string('question');
                $table->text('answer');
                $table->string('keywords', 500)->nullable();
                $table->integer('order')->default(0);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('chatbot_conversations')) {
            Schema::create('chatbot_conversations', function (Blueprint $table) {
                $table->id();
                $table->string('session_id')->index();
                $table->text('user_message');
                $table->text('bot_reply');
                $table->string('ip_address', 45)->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('redirects')) {
            Schema::create('redirects', function (Blueprint $table) {
                $table->id();
                $table->string('source_url')->unique();
                $table->string('target_url');
                $table->integer('status_code')->default(301);
                $table->boolean('is_active')->default(true);
                $table->unsignedBigInteger('hits')->default(0);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('redirects');
        Schema::dropIfExists('chatbot_conversations');
        Schema::dropIfExists('chatbot_qas');
        Schema::dropIfExists('tech_stack');
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('team_members');
        Schema::dropIfExists('portfolio_projects');
        Schema::dropIfExists('process_steps');
        Schema::dropIfExists('differentiators');
        Schema::dropIfExists('products');
        Schema::dropIfExists('content_blocks');
        Schema::dropIfExists('seo_meta');
    }
};
