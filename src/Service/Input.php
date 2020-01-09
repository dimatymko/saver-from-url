<?php

namespace App\Service;


use InvalidArgumentException;

class Input
{
    /**
     * @var array
     */
    private $argv;

    public function __construct(array $argv = [])
    {
        $this->argv = $argv;
    }

    public function getUrl(): string
    {

        if (!filter_var($this->argv[1], FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException('Please enter valid url.');
        }

        return $this->argv[1];
    }
}
