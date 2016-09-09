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

/**
 * Stores Table elements.
 *
 * @author laSyntez <lasyntez@gmail.com>
 */
interface StorageInterface
{
    /**
     * Add a table element to the storage
     *
     * @param   mixed   $element
     * @param   mixed   $data
     *
     * @return \SplObjectStorage|array
     */
    public function attach($element, $data = null);

    /**
     * Add table elements to the storage
     *
     * @param   array   $elements
     */
    public function attachAll(array $elements);

    /**
     * Remove a table element from the storage
     *
     * @param   mixed   $element
     */
    public function detach($element);

    /**
     * Get the number of the table elements stored
     *
     * @return int
     */
    public function count();

    /**
     * Get all the table elements stored
     *
     * @return \SplObjectStorage|array
     */
    public function getAll();
}
