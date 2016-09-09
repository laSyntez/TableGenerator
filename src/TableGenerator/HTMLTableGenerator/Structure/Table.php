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

use TableGenerator\HTMLTableGenerator\Attributes\AttributesHandler;
use TableGenerator\HTMLTableGenerator\Exception\InvalidAttributeException;
use TableGenerator\Storage\StorageInterface;

/**
 * Table represents an HTML Table (an HTML tag).
 *
 * @author laSyntez <lasyntez@gmail.com>
 */
class Table
{
	/**
	 * The type of storage used for the rows
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
	 * @param   \TableGenerator\Storage\StorageInterface   $storage   The type of storage used for the rows
	 * @param   \TableGenerator\HTMLTableGenerator\Attributes\AttributesHandler   $handler   The html attributes handler
	 */
	public function __construct(StorageInterface $storage, AttributesHandler $handler = null)
	{
		$this->storage = $storage;
		$this->attributesHandlder = $handler;
	}

	/**
	 * Adds a row to the table
	 *
	 * @param Row $row
	 *
	 * @return Table
	 */
	public function addRow(Row $row)
	{
		$this->storage->attach($row);

		return $this;
	}

	/**
	 * Removes a row from the table
	 *
	 * @param Row $row
	 *
	 * @return Table
	 */
	public function removeRow(Row $row)
	{
		$this->storage->detach($row);

		return $this;
	}

	/**
	 * Adds rows to the table
	 *
	 * @param array $rows
	 *
	 * @return Table
	 */
	public function addRows(array $rows)
	{
		$this->storage->attachAll($rows);

		return $this;
	}

	/**
	 * Gets the rows of the table
	 *
	 * @return \SplObjectStorage|array
	 */
	public function getRows()
	{
		return $this->storage->getAll();
	}

	/**
	 * Gets the number of rows inside the table
	 *
	 * @return array
	 */
	public function countRows()
	{
		return $this->storage->count();
	}

	/**
	 * Sets the attributes of the table
	 *
	 * @param array $attributes
	 *
	 * @return Table
	 */
	public function setAttributes(array $attributes)
	{
		$this->attributesHandlder->setAttributes($attributes);

		return $this;
	}

	/**
	 * Gets the attributes of the table
	 *
	 * @return array
	 */
	public function getAttributes()
	{
		return $this->attributesHandlder->getAttributes();
	}

	/**
	 * Sets the attributes handler of the table
	 *
	 * @param \TableGenerator\HTMLTableGenerator\Attributes\AttributesHandler $handler
	 *
	 * @return Table
	 */
	public function setAttributesHandler(AttributesHandler $handler)
	{
		$this->attributesHandlder = $handler;

		return $this;
	}

	/**
	 * Gets the attributes handler of the table
	 *
	 * @return \TableGenerator\HTMLTableGenerator\Attributes\AttributesHandler
	 */
	public function getAttributesHandler()
	{
		return $this->attributesHandlder;
	}

	/**
	 * Generates the html code of the table
	 *
	 * @return string
	 */
	public function generate()
	{
		$output = '<table';
		if (null != $this->attributesHandlder) {
			$output .= $this->attributesHandlder->generate();
		}

		$output .= '>';

		$rows = $this->getRows();
		foreach ($rows as $row) {
			$output.= $row->generate();
		}

		$output .= '</table>';

		return $output;
	}
}
