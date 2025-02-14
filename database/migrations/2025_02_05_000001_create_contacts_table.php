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
        Schema::create('clients', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->string('name');
            $table->string('email')->nullable();
            $table->bigInteger('phone')->nullable()->unsigned();
            $table->bigInteger('inn')->unsigned();
            $table->bigInteger('ogrn')->nullable()->unsigned();
            $table->integer('kpp')->nullable()->unsigned();
            $table->timestamps();
        });

        Schema::create('sales_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('space_id')->constrained()->references('id')->on('spaces')->onDelete('cascade');
            $table->string('name')->unique()->comment('Название статуса');
            $table->string('slug')->unique()->comment('Уникальный идентификатор');
        });

        Schema::create('support_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('space_id')->constrained()->references('id')->on('spaces')->onDelete('cascade');
            $table->string('name')->unique()->comment('Название статуса');
            $table->string('slug')->unique()->comment('Уникальный идентификатор');
        });

        Schema::create('contacts', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->foreignUuid('client_uuid')->nullable()->constrained()->references('uuid')->on('clients')->onDelete('cascade');
            $table->bigInteger('chat_id')->unsigned()->unique();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->bigInteger('phone')->unsigned()->nullable();
            $table->foreignId('sales_status_id')->nullable()->constrained()->references('id')->on('sales_statuses')->onDelete('cascade');
            $table->foreignId('support_status_id')->nullable()->constrained()->references('id')->on('support_statuses')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
        Schema::dropIfExists('sales_statuses');
        Schema::dropIfExists('support_statuses');
        Schema::dropIfExists('clients');
    }
};
