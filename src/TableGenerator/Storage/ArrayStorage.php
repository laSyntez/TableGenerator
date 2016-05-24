<?php

namespace TableGenerator\Storage;

use TableGenerator\Structure\GeneratorInterface;

class ArrayStorage implements StorageInterface
{
    protected $storage = array();

    public function attach($element, $data = null)
    {
        $this->storage[spl_object_hash($element)] = $element;
    }

    public function detach($element)
    {
        $hash = spl_object_hash($element);
        if (isset($this->storage[$hash])) {
            unset($this->storage[$hash]);
        }
    }

    public function getAll()
    {
        return $this->storage;
    }

    public function count()
    {
        return count($this->storage);
    }
}
