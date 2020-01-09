<?php

namespace App\Service\Saver;

class ResourceSaver implements SaverInterface
{
    /**
     * @var string
     */
    private $uploadDir;

    public function __construct(string $uploadDir)
    {
        $this->uploadDir = $uploadDir;
    }

    public function save(string $link): void
    {
        $folder = uniqid('process-');
        $this->makeDir($this->uploadDir.'/'.$folder);
        $this->saveFile($this->uploadDir.'/'.$folder, $link);
    }

    private function makeDir($folder): bool
    {
        // Check if created
        return mkdir($folder, 0777, true);
    }

    private function saveFile(string $folder, string $link): void
    {
        $filename = $this->getNameFromLink($link);

        $input = fopen($link, 'rb');
        $this->makeDir(dirname($folder.'/'.$filename));
        $output = fopen($folder.'/'.$filename, 'w+b');

        while (!feof($input)) {
            fwrite($output, fread($input, 8192), 8192);
        }

        fclose($input);
        fclose($output);
    }

    private function getNameFromLink(string $link): string
    {
        return implode('/', array_slice(explode('/', $link), 2));
    }
}
