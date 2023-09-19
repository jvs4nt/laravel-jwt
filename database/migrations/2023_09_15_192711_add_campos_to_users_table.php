<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCamposToUsersTable extends Migration

{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('telefone')->nullable();
            $table->string('genero')->nullable();
            $table->string('esporteFav')->nullable();
            $table->string('estado')->nullable();
            $table->string('cidade')->nullable();
            $table->string('bairro')->nullable();
            $table->string('rua')->nullable();
        });
    }
     

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Reverta as alterações, se necessário
            $table->dropColumn('telefone');
            $table->dropColumn('genero');
            $table->dropColumn('esporteFav');
            $table->dropColumn('estado');
            $table->dropColumn('cidade');
            $table->dropColumn('bairro');
            $table->dropColumn('rua');
        });
    }

}
