<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('tickets', function (Blueprint $table) {
        $table->increments('id');
        $table->string('user_email');
        $table->integer('category_id')->unsigned();
        $table->string('ticket_id')->unique();
        $table->string('title');
        $table->string('priority');
        $table->text('message');
        $table->string('status');
        $table->timestamps();
      });

      Schema::create('ticket_categories', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->timestamps();
      });

      Schema::create('ticket_comments', function (Blueprint $table) {
    		$table->increments('id');
    		$table->integer('ticket_id')->unsigned();
    		$table->string('user_email');
    		$table->text('comment');
    		$table->timestamps();
		  });
      Schema::create('ticket_status', function(Blueprint $table){
        $table->increments('id');
        $table->string('name');
      });
      Schema::create('ticket_priority', function(Blueprint $table){
        $table->increments('id');
        $table->string('name');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('tickets');
      Schema::dropIfExists('ticket_categories');
      Schema::dropIfExists('ticket_comments');
      Schema::dropIfExists('ticket_status');
      Schema::dropIfExists('ticket_priority');
    }
}
