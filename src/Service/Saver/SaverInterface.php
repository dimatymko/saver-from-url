<?php

namespace App\Service\Saver;

interface SaverInterface
{
    public function save(string $data): void;
}
