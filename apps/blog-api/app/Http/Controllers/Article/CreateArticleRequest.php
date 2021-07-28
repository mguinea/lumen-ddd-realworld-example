<?php

declare(strict_types=1);

namespace Apps\BlogApi\App\Http\Controllers\Article;

use Apps\BlogApi\App\Http\Controllers\Controller;

final class CreateArticleRequest extends Controller
{
    public function __construct()
    {
    }

    public function rules()
    {
        return [
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
        ];
    }
}
