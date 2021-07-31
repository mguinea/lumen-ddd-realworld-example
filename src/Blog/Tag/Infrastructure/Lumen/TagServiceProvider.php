<?php

declare(strict_types=1);

namespace App\Blog\Tag\Infrastructure\Lumen;

use App\Blog\Tag\Application\ListingTagsQueryHandler;
use App\Blog\Tag\Domain\TagRepository;
use App\Blog\Tag\Infrastructure\Persistence\Eloquent\EloquentTagRepository;
use Illuminate\Support\ServiceProvider;

final class TagServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            TagRepository::class,
            EloquentTagRepository::class
        );

        $this->app->tag(
            ListingTagsQueryHandler::class,
            'query_handler'
        );
    }
}
