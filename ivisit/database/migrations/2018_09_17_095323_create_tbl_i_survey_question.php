<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblISurveyQuestion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('sqlite')->create('tbl_iSurveyQuestion', function (Blueprint $table) {
            $table->increments('Qid');
            $table->string('Question');
            $table->string('CreatedBy');
            $table->dateTime('CreatedDate');
            $table->string('ChangedBy');
            $table->dateTime('ChangedDate');
            $table->integer('headingid');
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
        Schema::dropIfExists('tbl_iSurveyQuestion');
    }
}
