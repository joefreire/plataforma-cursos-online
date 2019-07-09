<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursosTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'cursos';

    /**
     * Run the migrations.
     * @table cursos
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('id');
            $table->string('nome');
            $table->longText('descricao')->nullable()->default(null);
            $table->longText('definicao_prova')->nullable();
            $table->string('subtitulo')->nullable();
            $table->string('imagem')->nullable()->default(null);
            $table->integer('instrutor_id');
            $table->integer('categoria_id')->nullable()->default(null);
            $table->string('duracao')->nullable()->default(null);
            $table->string('valor', 20)->nullable()->default(null);
            $table->string('nivel')->nullable()->default(null);
            $table->integer('stars')->nullable()->default(null);
            $table->integer('aprovado')->nullable()->default(null);
            $table->string('comissao', 5)->nullable()->default(null);
            $table->string('video')->nullable()->default(null);
            $table->string('album_vimeo', 45);
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
