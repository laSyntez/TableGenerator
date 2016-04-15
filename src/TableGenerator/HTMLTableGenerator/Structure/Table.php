<?php

namespace TableGenerator\HTMLTableGenerator\Structure;

use TableGenerator\HTMLTableGenerator\Exception\InvalidAttributeException;

class Table
{	
	protected $rows = array();
	protected $attributesHandlder;

	public function __construct(array $rows = array(), AttributesHandler $handler = null) {
		$this->rows = $rows;
		$this->attributesHandlder = $handler;
	}
	
	public function addRow(TR $tr) 
	{
		$this->rows[] = $tr;

		return $this;
	}
	
	public function removeRow(row $row) 
	{
		$this->rows[] = $row;
	}
	
	public function generate()
	{
		$output = '<table';		
		if (null != $this->attributesHandlder) {
			$output .= $this->attributesHandlder->generate();		
		}
		$output .= '>';
		foreach ($this->rows as $row) {
			$output.= $row->generate();
		}
		$output .= '</table>';
	
		return $output;
	}
	
	public function setAttributes(array $attributes) 
	{
		$this->attributesHandlder->setAttributes($attributes);
	}
	
	public function getAttributes()
	{
		return $this->attributesHandlder->getAttributes();
	}
	
	public function setAttributesHandler(AttributesHandler$handler) 
	{
		$this->attributesHandlder = $handler;
	}
	
	public function getAttributesHandler()
	{
		return $this->attributesHandlder;
	}
}


