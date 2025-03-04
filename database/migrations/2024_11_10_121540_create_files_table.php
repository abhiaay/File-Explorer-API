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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('folder_id')->nullable();
            $table->string('name');
            $table->bigInteger('size')->comment('the size of files in bytes');
            $table->timestamps();

            $table->foreign('folder_id')->on('folders')->references('id')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('files', function(Blueprint $table) {
            $table->dropForeign(['folder_id']);
        });
        Schema::dropIfExists('files');
    }
};
