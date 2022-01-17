<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class WbPackages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wb_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('outlet_id');
            $table->enum('package_type', ['HEAVY', 'BLANKET', 'BED_COVER', 'KAOS', 'OTHERS']);
            $table->string('package_name', 100);
            $table->double('package_price');
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
        Schema::dropIfExists('wb_packages');
    }
}
