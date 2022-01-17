
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class WbMembers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wb_members', function (Blueprint $table) {
            $table->id();
            $table->string('member_name', 100);
            $table->text('member_address');
            $table->string('member_phone', 16);
            $table->enum('member_gender', ['MALE', 'FEMALE']);
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
        Schema::dropIfExists('wb_members');
    }
}
