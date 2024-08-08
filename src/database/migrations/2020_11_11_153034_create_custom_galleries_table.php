<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_gallery', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gallery_id')
                ->nullable()
                ->constrained('gallery')
                ->cascadeOnDelete();
            $table->string('title', 255);
            $table->text('lead')
                ->nullable();
            $table->mediumText('text')
                ->nullable();
            $table->string('lang', 10);
            $table->bigInteger('position')
                ->default(0);
            $table->boolean('active')
                ->default(false);
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
        Schema::dropIfExists('custom_gallery');
    }
}
