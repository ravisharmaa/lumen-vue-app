<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('sqlite')->create('AppUsers', function (Blueprint $table) {
            $table->increments('UserId');
            $table->string('UserName');
            $table->string('Password');
            $table->boolean('ActiveFlag')->default(0);
            $table->boolean('SalesRepStatus')->default(0);
            $table->string('SalesRepDepartment');
            $table->string('SalesRepName');
            $table->boolean('isPasswordChanged')->default(0);
            $table->string('SalesRepLanguage');
            $table->integer('visitLimit');
            $table->string('accessDepartment')->nullable();
            $table->string('salesRepAssistantEmail')->nullable();
            $table->string('UserToken');
            $table->string('appVersion')->default('0.0.0');
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
        Schema::dropIfExists('AppUsers');
    }
}
