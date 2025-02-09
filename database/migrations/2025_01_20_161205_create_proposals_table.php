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
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('leader_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->string( 'file');
            $table->string( 'team_name');
            $table->enum('status', ['new', 'revision', 'accepted', 'rejected'])->default('new');
            $table->foreignId('faculty_id')->constrained('faculties')->onDelete('cascade');
            $table->enum('scheme', ['K', 'KC', 'KI', 'VGK', 'GFT', 'RE', 'RSH', 'PM', 'PI', 'AI']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposals');
    }
};
