<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_configs', function (Blueprint $table) {
            $table->id();
            $table->string('url_config', 20)->comment('URL default');
            $table->string('username_config', 20)->comment('Username default for APIs');
            $table->string('password_config')->comment('Password default for APIs');
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
        Schema::dropIfExists('m_configs');
    }
}
