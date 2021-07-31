<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoomePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hoome_pages', function (Blueprint $table) {
            $table->id();
            $table->longText('sliders') -> nullable();
            $table->longText('wwa') -> nullable();
            $table->longText('vision') -> nullable();
            $table->longText('clients') -> nullable();
            $table->longText('testimonials') -> nullable();
            $table->longText('setup') -> nullable();
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
        Schema::dropIfExists('hoome_pages');
    }
}
