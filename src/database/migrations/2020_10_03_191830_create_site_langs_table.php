<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteLangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_lang', function (Blueprint $table) {
            $table->id();
            $table->string('name', 25);
            $table->string('full_name', 255);
            $table->boolean('default_site')
                ->default(false);
            $table->boolean('default_admin')
                ->default(false);
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
        Schema::dropIfExists('site_lang');
    }
}
