<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendasTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'vendas';

    /**
     * Run the migrations.
     * @table vendas
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cliente_id');
            $table->integer('status')->nullable()->default(null)->comment('0 - aberto, 1 - fechado, 2 - cancelado');
            $table->decimal('total', 11, 2);
            $table->integer('afiliado')->nullable()->default(null);
            $table->decimal('comissao', 11, 0)->nullable()->default(null);
            $table->text('meio_pagamento')->nullable();
            $table->string('transacao')->nullable();

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
