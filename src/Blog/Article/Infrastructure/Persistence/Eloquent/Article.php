<?php

declare(strict_types=1);

namespace App\Blog\Article\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;

final class Article extends Model
{
    protected $casts = [
        'favourited' => 'boolean',
        'favorites_count' => 'integer'
    ];
    protected $connection = 'mysql_blog';
    protected $keyType = 'string';
    protected $primaryKey = 'id';
    protected $table = 'articles';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'id',
        'slug',
        'title',
        'description',
        'body',
        'created_at',
        'updated_at',
        'favourited',
        'favorites_count'
    ];
}
