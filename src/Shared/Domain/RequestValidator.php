<?php

namespace App\Shared\Domain;

interface RequestValidator
{
    public function validate($request, array $rules, array $messages = [], array $customAttributes = []): void;
}
