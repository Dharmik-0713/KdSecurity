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
        Schema::create('audit_targets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->string('name');          // e.g. app.techcorp.io
            $table->string('label')->nullable(); // e.g. Main Web Application
            $table->string('status')->default('queued'); // queued, in_progress, completed
            $table->integer('progress')->default(0); // 0-100
            $table->integer('critical')->default(0);
            $table->integer('high')->default(0);
            $table->integer('medium')->default(0);
            $table->integer('low')->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_targets');
    }
};