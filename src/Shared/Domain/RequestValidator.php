<?php

namespace App\Shared\Domain;

use Psr\Http\Message\RequestInterface;

interface RequestValidator
{
    public function validate(RequestInterface $request, array $validations): void;
}
