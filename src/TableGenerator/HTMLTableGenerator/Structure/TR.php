<?php

namespace TableGenerator\HTMLTableGenerator\Structure;

use TableGenerator\GeneratorInterface;
use TableGenerator\Storage\StorageInterface;
use TableGenerator\HTMLTableGenerator\Attributes\AttributesHandler;

class Row
{
	protected $storage;
	protected $attributesHandlder;

	/**
	 * Get the html code of the cell
	 *
	 * @param StorageInterface $storage
	 * @param AttributesHandler $handler
	 *
	 * @return string
	 */
	public function __construct(StorageInterface $storage, AttributesHandler $handler = null)
	{
		$this->storage = $storage;
		$this->attributesHandlder = $handler;
	}

	public function addCell(Cell $cell)
	{
		$this->storage->attach($cell);

		return $this;
	}

	public function removeCell(Cell $cell)
	{
		$this->storage->detach($cell);

		return $this;
	}

	public function addCells(array $cells)
	{
		$this->storage->attachAll($cells);

		return $this;
	}

	public function getCells()
	{
		return $this->storage->getAll();
	}

	public function countCells()
	{
		return $this->storage->count();
	}

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

	/**
	 * Set the attributes of the row
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
	 * Get the attributes of the row
	 *
	 * @return array
	 */
	public function getAttributes()
	{
		return $this->attributes->getAttributes();
	}

	/**
	 * Set the attributes handler of the row
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

	public function getAttributesHandler()
	{
		return $this->attributesHandlder;
	}
}
