<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateURLTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('url', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('url');
            $table->string('status');
            $table->timestamps();
        });

        Schema::table('url', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('url', function (Blueprint $table) {
          if(Schema::hasColumn('url', 'user_id')){
              $table->dropForeign('url_user_id_foreign');
              $table->dropColumn('user_id');
          }
         
      });
        Schema::dropIfExists('url');
    }
}
