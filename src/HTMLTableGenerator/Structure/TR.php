<?php

namespace HTMLTableGenerator\Structure;

class TR
{		
	protected $cells = array();
	protected $attributesHandlder;

	public function __construct(array $cells = array(), array $attributes = array()) {
		$this->cells = $cells;
		$this->attributesHandlder = new AttributesHandler($attributes);
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
}


