<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersCursosTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'users_cursos';

    /**
     * Run the migrations.
     * @table users_cursos
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->integer('curso_id');
            $table->integer('andamento')->nullable()->default(null);
            $table->date('data');
            $table->integer('nota')->nullable()->default(null);
            $table->date('data_nota')->nullable()->default(null);

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
