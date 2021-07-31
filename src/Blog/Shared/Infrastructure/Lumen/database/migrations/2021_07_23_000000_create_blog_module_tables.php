<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogModuleTables extends Migration
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
            'users',
            function (Blueprint $table) {
                $table->uuid('id')->primary()->unique();
                $table->string('username')->unique();
                $table->string('email')->unique();
                $table->string('bio')->nullable();
                $table->string('image')->nullable();
                $table->timestamps();
            }
        );

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
                $table->uuid('user_id');
            }
        );

        Schema::connection($this->connection)->create(
            'comments',
            function (Blueprint $table) {
                $table->uuid('id')->primary()->unique();
                $table->string('body')->unique();
                $table->timestamps();
                $table->uuid('article_id');
            }
        );

        Schema::connection($this->connection)->create(
            'article_tag',
            function (Blueprint $table) {
                $table->uuid('article_id');
                $table->uuid('tag_id');
            }
        );

        Schema::connection($this->connection)->create(
            'tags',
            function (Blueprint $table) {
                $table->uuid('id')->primary()->unique();
                $table->string('value')->unique();
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
        Schema::connection($this->connection)->dropIfExists('users');
        Schema::connection($this->connection)->dropIfExists('articles');
    }
}
