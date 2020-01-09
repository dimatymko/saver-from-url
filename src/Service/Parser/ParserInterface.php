<?php

namespace App\Service\Parser;

interface ParserInterface
{
    public function getResources(): array;

    public function parse(string $content): void;
}
