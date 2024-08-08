<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('field', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')
                ->constrained('page')
                ->cascadeOnDelete();
            $table->string('type', 255)
                ->default('text');
            $table->string('name', 255);
            $table->string('label', 255)
                ->nullable();
            $table->text('value')
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
        Schema::dropIfExists('field');
    }
}
