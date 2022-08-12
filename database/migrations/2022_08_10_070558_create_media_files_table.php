<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media_files', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('imageable_id')->nullable();
            $table->string('imageable_type')->nullable();
            $table->string('file_path')->nullable();
            $table->string('file_alias')->nullable();
            $table->string('file_name')->nullable();
            $table->string('file_ext')->nullable();
            $table->string('file_type')->nullable();
            $table->string('file_mime')->nullable();
            $table->string('file_size')->nullable();
            $table->string('file_caption')->nullable();
            $table->text('file_detail')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('media_files');
    }
};
