<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_category_id')
                ->nullable()
                ->constrained('article_category')
                ->nullOnDelete();
            $table->foreignId('seo_id')
                ->unique()
                ->constrained('seo')
                ->cascadeOnDelete();
            $table->foreignId('gallery_id')
                ->nullable()
                ->constrained('gallery')
                ->nullOnDelete();
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
        Schema::dropIfExists('article');
    }
}
