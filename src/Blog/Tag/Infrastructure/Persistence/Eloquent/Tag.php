<?php

declare(strict_types=1);

namespace App\Blog\Tag\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;

final class Tag extends Model
{
    protected $connection = 'mysql_blog';
    protected $keyType = 'string';
    protected $primaryKey = 'id';
    protected $table = 'tags';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'id',
        'value'
    ];
}
