<?php

namespace TableGenerator\Storage;

use TableGenerator\Structure\GeneratorInterface;

interface StorageInterface
{
    public function attach($element, $data = null);
    public function attachAll(array $elements);
    public function detach($element);
    public function count();
    public function getAll();
}
