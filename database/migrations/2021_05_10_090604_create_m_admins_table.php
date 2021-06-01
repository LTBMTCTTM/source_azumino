<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_admins', function (Blueprint $table) {
            $table->string('admin_id', 20)->comment('管理者コード')->primary();
            $table->string('admin_name', 50)->nullable(false)->comment('管理者名');
            $table->string('admin_pass', 20)->default('')->comment('管理者パスワード');
            $table->string('password')->comment('Password hash')->default('');
            $table->datetime('last_update')->nullable(true)->comment('最終更新日時');
            $table->tinyInteger('delete_flag')->default(1)->nullable(false)->comment('削除フラグ 1:削除 0:未削除');
            $table->rememberToken();
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
        Schema::dropIfExists('m_admins');
    }
}
