<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsuarioIdToPostsTable extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('posts', 'usuario_id')) {
            Schema::table('posts', function (Blueprint $table) {
                $table->unsignedBigInteger('usuario_id')->nullable()->after('id');
                $table->foreign('usuario_id')->references('id')->on('usuarios');
            });
        }
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['usuario_id']);
            $table->dropColumn('usuario_id');
        });
    }
}
