<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNavItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nav_item', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nav_item_id')
                ->nullable()
                ->constrained('nav_item')
                ->cascadeOnDelete();
            $table->foreignId('page_id')
                ->nullable()
                ->constrained('page')
                ->nullOnDelete();
            $table->string('nav_name', 100);
            $table->string('label', 255)
                ->nullable();
            $table->string('url', 255)
                ->nullable();
            $table->string('target', 255)
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
        Schema::dropIfExists('nav_item');
    }
}
