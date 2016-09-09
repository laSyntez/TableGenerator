<?php

/*
 * This file is part of the TableGenerator package.
 *
 * (c) laSyntez <lasyntez@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TableGenerator\Storage;

use TableGenerator\Structure\GeneratorInterface;

class SplStorage extends \SplObjectStorage implements StorageInterface
{
    /**
     * {@inheritdoc}
     */
    public function getAll()
    {
        return $this;
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
