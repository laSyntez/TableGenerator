<?php

namespace TableGenerator\Storage;

use TableGenerator\Structure\GeneratorInterface;

class SplStorage extends \SplObjectStorage implements StorageInterface
{
    public function getAll()
    {
        return $this;
    }
}
