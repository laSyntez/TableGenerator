<?php

namespace TableGenerator\HTMLTableGenerator\Structure;

class TR
{		
	protected $cells;
	protected $attributesHandlder;

	public function __construct(array $cells = array(), AttributesHandler $handler = null) {
		$this->cells = $cells;
		$this->attributesHandlder = $handler;
	}
	
	public function addCell(Cell $cell) 
	{
		$this->cells[] = $cell;

		return $this;
	}
	
	public function removeCell(Cell $cell) 
	{
		$this->cells[] = $cell;
	}
	
	public function generate()
	{
		$output = '<tr';
		if (null != $this->attributesHandlder) {
			$output .= $this->attributesHandlder->generate();		
		}
		$output .= '>';
		foreach ($this->cells as $cell) {
			$output.= $cell->generate();
		}
		$output .= '</tr>';
	
		return $output;
	}
	
	public function hasCells()
	{
		return 0 < count($this->cells);
	}
	
	public function countCells() 
	{
		return count($this->cells);
	}
	
	public function setAttributes(array $attributes) 
	{
		$this->attributesHandlder->setAttributes($attributes);
		
		return $this;
	}
	
	public function getAttributes()
	{
		return $this->attributes->getAttributes();
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


