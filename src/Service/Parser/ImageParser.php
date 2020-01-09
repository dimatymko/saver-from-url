<?php

namespace App\Service\Parser;

class ImageParser implements ParserInterface
{
    private const PATTERN = "#<img(.*)src=['\"]{1}(?<url>http[\s\-0-9:a-z\/\.\?\&=;]+[{{extensions}}])[\'\"]#im";

    /**
     * @var array
     */
    private $resources;

    /**
     * @var array
     */
    private $extensions;

    public function __construct(array $extensions = ['png', 'jpg', 'jpeg', 'gif'])
    {
        $this->extensions = $extensions;
    }

    public function getResources(): array
    {
        return $this->resources;
    }

    public function parse(string $content): void
    {
        preg_match_all(
            str_replace('{{extensions}}', implode('|', $this->extensions), static::PATTERN),
            $content,
            $matches
        );
        $this->resources = $matches['url'];
    }
}
