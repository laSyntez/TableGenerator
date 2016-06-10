<?php

namespace TableGenerator\HTMLTableGenerator\Structure;

use TableGenerator\HTMLTableGenerator\Attributes\AttributesHandler;
use TableGenerator\HTMLTableGenerator\Exception\InvalidAttributeException;
use TableGenerator\Storage\StorageInterface;

class Table
{
	protected $storage;
	protected $attributesHandlder;

	public function __construct(StorageInterface $storage, AttributesHandler $handler = null)
	{
		$this->storage = $storage;
		$this->attributesHandlder = $handler;
	}

	public function addRow(TR $tr)
	{
		$this->storage->attach($tr);

		return $this;
	}

	public function removeRow(TR $tr)
	{
		$this->storage->detach($tr);

		return $this;
	}

	public function addRows(array $rows)
	{
		$this->storage->attachAll($rows);

		return $this;
	}

	public function getRows()
	{
		return $this->storage->getAll();
	}

	public function countRows()
	{
		return $this->storage->count();
	}

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

	public function setAttributes(array $attributes)
	{
		$this->attributesHandlder->setAttributes($attributes);

		return $this;
	}

	public function getAttributes()
	{
		return $this->attributesHandlder->getAttributes();
	}

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
