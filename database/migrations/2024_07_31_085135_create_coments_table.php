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
        Schema::create('coments', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('id_post')->constrained('posts')->onDelete('cascade'); // Cambiamos 'id_posts' a 'id_post'
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Relación con User
            $table->text('content');
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coments');
    }
};
