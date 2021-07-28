<?php

declare(strict_types=1);

namespace App\Blog\Article\Application;

use App\Blog\Article\Domain\Article;
use App\Shared\Domain\Arrayable;
use App\Shared\Domain\Bus\Query\Response;

final class ArticleResponse implements Arrayable, Response
{
    public function __construct(
        private string $slug,
        private string $title,
        private string $description,
        private string $body,
    ) {
    }

    public static function fromArticle(Article $article): self
    {
        return new self(
            $article->slug()->value(),
            $article->title()->value(),
            $article->description()->value(),
            $article->body()->value()
        );
    }

    public function slug(): string
    {
        return $this->slug;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function body(): string
    {
        return $this->body;
    }

    public function toArray(): array
    {
        return [
            'slug' => $this->slug,
            'title' => $this->title,
            'description' => $this->description,
            'body' => $this->body
        ];
        /*
        return [
            'slug' => 'how-to-train-your-dragon',
            'title' => 'How to train your dragon',
            'description' => 'Ever wonder how?',
            'body' => 'It takes a Jacobian',
            'tagList' => ['dragons', 'training'],
            'createdAt' => '2016-02-18T03=>22=>56.637Z',
            'updatedAt' => '2016-02-18T03=>48=>35.824Z',
            'favorited' => false,
            'favoritesCount' => 0,
            'author' => [
                'username' => 'jake',
                'bio' => 'I work at statefarm',
                'image' => 'https=>//i.stack.imgur.com/xHWG8.jpg',
                'following' => false
            ]
        ];
        //*/
    }
}
