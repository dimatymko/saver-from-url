<?php

use App\Service\Parser\ImageParser;
use App\Service\Saver\ResourceSaver;

return [
    'saver'  => new ResourceSaver('upload'),
    'parser' => new ImageParser(),
];
