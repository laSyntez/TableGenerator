<?php

namespace TableGenerator\Storage;

use TableGenerator\Structure\GeneratorInterface;

class SplStorage extends \SplObjectStorage implements StorageInterface
{
    public function getAll()
    {
        return $this;
    }

    public function attachAll(array $elements)
    {
        foreach ($elements as $element) {
            $this->attach($element);
        }

        return $this;
    }
}
