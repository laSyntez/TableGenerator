<?php

/*
 * This file is part of the TableGenerator package.
 *
 * (c) laSyntez <lasyntez@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TableGenerator\HTMLTableGenerator\Structure;

use TableGenerator\GeneratorInterface;
use TableGenerator\Storage\StorageInterface;
use TableGenerator\HTMLTableGenerator\Attributes\AttributesHandler;
use TableGenerator\HTMLTableGenerator\Structure\Cell;

/**
 * Row represents an HTML Table row (an HTML tag).
 *
 * @author laSyntez <lasyntez@gmail.com>
 */
class Row
{
	/**
	 * The type of storage used for the cells
	 *
	 * @var \TableGenerator\Storage\StorageInterface
	 */
	protected $storage;

	/**
	 * The html attributes handler
	 *
	 * @var \TableGenerator\HTMLTableGenerator\Attributes\AttributesHandler
	 */
	protected $attributesHandlder;

	/**
	 * Constructor.
	 *
	 * @param   StorageInterface   $storage   The type of storage used for the cells
	 * @param   AttributesHandler   $handler   The attributes handler
	 */
	public function __construct(StorageInterface $storage, AttributesHandler $handler = null)
	{
		$this->storage = $storage;
		$this->attributesHandlder = $handler;
	}

	/**
	 * Adds a cell to the row
	 *
	 * @param Cell $cell
	 *
	 * @return Row
	 */
	public function addCell(Cell $cell)
	{
		$this->storage->attach($cell);

		return $this;
	}

	/**
	 * Remove a cell from the row
	 *
	 * @param Cell $cell
	 *
	 * @return Row
	 */
	public function removeCell(Cell $cell)
	{
		$this->storage->detach($cell);

		return $this;
	}

	/**
	 * Adds cells to the row
	 *
	 * @param array $cells
	 *
	 * @return Row
	 */
	public function addCells(array $cells)
	{
		$this->storage->attachAll($cells);

		return $this;
	}

	/**
	 * Gets the cells of the row
	 *
	 * @return \SplObjectStorage|array
	 */
	public function getCells()
	{
		return $this->storage->getAll();
	}

	/**
	 * Gets the number of cells inside the row
	 *
	 * @return array
	 */
	public function countCells()
	{
		return $this->storage->count();
	}

	/**
	 * Sets the attributes of the row
	 *
	 * @param array $attributes
	 *
	 * @return Row
	 */
	public function setAttributes(array $attributes)
	{
		$this->attributesHandlder->setAttributes($attributes);

		return $this;
	}

	/**
	 * Gets the attributes of the row
	 *
	 * @return array
	 */
	public function getAttributes()
	{
		return $this->attributes->getAttributes();
	}

	/**
	 * Sets the attributes handler of the row
	 *
	 * @param \TableGenerator\HTMLTableGenerator\Attributes\AttributesHandler $handler
	 *
	 * @return Row
	 */
	public function setAttributesHandler(AttributesHandler $handler)
	{
		$this->attributesHandlder = $handler;

		return $this;
	}

	/**
	 * Gets the attributes handler of the row
	 *
	 * @return \TableGenerator\HTMLTableGenerator\Attributes\AttributesHandler
	 */
	public function getAttributesHandler()
	{
		return $this->attributesHandlder;
	}

	/**
	 * Generates the html code of the row
	 *
	 * @return string
	 */
	public function generate()
	{
		$output = '<tr';
		if (null != $this->attributesHandlder) {
			$output .= $this->attributesHandlder->generate();
		}

		$output .= '>';

		$cells = $this->getCells();
		foreach ($cells as $cell) {
			$output.= $cell->generate();
		}

		$output .= '</tr>';

		return $output;
	}
}
