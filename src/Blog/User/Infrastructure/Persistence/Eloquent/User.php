<?php

namespace App\Blog\User\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $connection = 'mysql_blog';
    protected $keyType = 'string';
    protected $primaryKey = 'id';
    protected $table = 'users';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'id',
        'username',
        'email',
        'bio',
        'image'
    ];
}
