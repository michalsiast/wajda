<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleryItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery_item', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gallery_id')
                ->constrained('gallery')
                ->cascadeOnDelete();
            $table->string('url', 255);
            $table->string('name', 255)
                ->nullable();
            $table->string('type', 255)
                ->default('item');
            $table->mediumText('text')
                ->nullable();
            $table->bigInteger('position')
                ->default(0);
            $table->boolean('active')
                ->default(true);
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
        Schema::dropIfExists('gallery_item');
    }
}
