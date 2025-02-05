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
        Schema::create('dialogs', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->bigInteger('chat_id');
            $table->timestamps();
        });

        Schema::create('messages', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->foreignUuid('dialog_uuid')->constrained()->references('uuid')->on('dialogs')->onDelete('cascade');
            $table->foreignUuid('contact_uuid')->constrained()->references('uuid')->on('contacts')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('dialogs_users', function (Blueprint $table) {
            $table->primary(['dialog_uuid', 'user_id']);
            $table->foreignUuid('dialog_uuid')->constrained()->references('uuid')->on('dialogs')->onDelete('cascade');
            $table->foreignId('user_id')->type('bigInteger')->constrained()->onDelete('cascade');
        });

        Schema::create('contacts_dialogs', function (Blueprint $table) {
            $table->primary(['contact_uuid', 'dialog_uuid']);
            $table->foreignUuid('contact_uuid')->constrained()->references('uuid')->on('contacts')->onDelete('cascade');
            $table->foreignUuid('dialog_uuid')->constrained()->references('uuid')->on('dialogs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dialogs');
        Schema::dropIfExists('messages');
        Schema::dropIfExists('dialogs_users');
        Schema::dropIfExists('contacts_dialogs');
    }
};
