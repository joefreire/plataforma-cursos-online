<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'users';

    /**
     * Run the migrations.
     * @table users
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('password')->nullable()->default(null);
            $table->rememberToken();
            $table->string('cpf')->nullable()->default(null);
            $table->string('dt_nascimento')->nullable()->default(null);
            $table->string('telefone')->nullable()->default(null);
            $table->string('endereco')->nullable()->default(null);
            $table->string('latitude')->nullable()->default(null);
            $table->string('longitude')->nullable()->default(null);
            $table->string('foto')->nullable()->default(null);
            $table->text('observacoes')->nullable()->default(null);
            $table->integer('acesso_id')->nullable()->default(null);
            $table->string('token')->nullable()->default(null);
            $table->integer('tipo')->nullable()->default(null);
            $table->string('capa')->nullable()->default(null);
            $table->string('numero', 15)->nullable();
            $table->string('complemento', 45)->nullable();
            $table->string('bairro', 45)->nullable();
            $table->string('cep', 45)->nullable();
            $table->string('cidade', 45)->nullable();
            $table->string('estado', 45)->nullable();
            $table->string('bankNumber')->nullable();
            $table->string('agencyNumber')->nullable();
            $table->string('agencyCheckNumber')->nullable();
            $table->string('accountNumber')->nullable();
            $table->string('accountCheckNumber')->nullable();

            $table->unique(["id"], 'id_UNIQUE');
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
       Schema::dropIfExists($this->set_schema_table);
     }
}
