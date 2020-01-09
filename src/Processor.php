<?php

namespace App;

use App\Service\Parser\ParserInterface;
use App\Service\Saver\ResourceSaver;
use App\Service\Saver\SaverInterface;
use Psr\Log\LoggerInterface;

class Processor
{
    /**
     * @var string
     */
    private $url;

    /**
     * @var ParserInterface
     */
    private $parser;

    /**
     * @var ResourceSaver
     */
    private $resourceSaver;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(
        string $url,
        ParserInterface $parser,
        SaverInterface $resourceSaver,
        LoggerInterface $logger
    ) {
        $this->url = $url;
        $this->parser = $parser;
        $this->resourceSaver = $resourceSaver;
        $this->logger = $logger;
    }

    public function run(): void
    {
        $content = $this->retrieveContent();
        $this->parser->parse($content);
        $resources = $this->parser->getResources();
        foreach ($resources as $resource) {
            $this->logger->info(sprintf('Get %s ...', $resource));
            $this->resourceSaver->save($resource);
            $this->logger->info('OK'.PHP_EOL);
        }
    }

    public function retrieveContent()
    {
        return file_get_contents($this->url);
    }
}
