<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    protected $connection = 'mysql_blog';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection($this->connection)->create(
            'articles',
            function (Blueprint $table) {
                $table->uuid('id')->primary()->unique();
                $table->string('slug')->unique();
                $table->string('title')->unique();
                $table->string('description')->unique();
                $table->string('body')->unique();
                $table->boolean('favourited');
                $table->integer('favorites_count');
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection($this->connection)->dropIfExists('articles');
    }
}
