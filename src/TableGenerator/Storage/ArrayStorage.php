<?php

/*
 * This file is part of the TableGenerator package.
 *
 * (c) laSyntez
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TableGenerator\Storage;

use TableGenerator\Structure\GeneratorInterface;

class ArrayStorage implements StorageInterface
{
    /**
     * @var array
     */
    protected $storage = array();

    /**
     * {@inheritdoc}
     */
    public function attach($element, $data = null)
    {
        $this->storage[spl_object_hash($element)] = $element;
    }

    /**
     * {@inheritdoc}
     */
    public function detach($element)
    {
        $hash = spl_object_hash($element);
        if (isset($this->storage[$hash])) {
            unset($this->storage[$hash]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getAll()
    {
        return $this->storage;
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->storage);
    }

    /**
     * {@inheritdoc}
     */
    public function attachAll(array $elements)
    {
        foreach ($elements as $element) {
            $this->attach($element);
        }

        return $this;
    }
}
