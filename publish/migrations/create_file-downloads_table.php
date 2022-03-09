<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileDownloadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_downloads', function (Blueprint $table) {
            $table->id();
            $table->string('display_name')->nullable();
            $table->string('group')->nullable();
            $table->string('disk')->nullable();
            $table->string('filepath')->nullable();
            $table->string('filename')->nullable();
            $table->string('mimetype')->nullable();
            $table->unsignedBigInteger('size')->nullable();
            $table->json('meta')->nullable();
            $table->timestamps();
            $table->unique(['disk', 'filepath']);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
