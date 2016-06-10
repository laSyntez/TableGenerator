<?php

namespace TableGenerator\HTMLTableGenerator\Structure;

trait Attributes
{	
	protected $attributes;
	
	public function setAttributes($attributes) 
	{
		if (null != $attributes) {
				foreach ($attributes as $k => $value) {
					if (!in_array($k, array(Table::ID_STYLE_SELECTOR, Table::CLASS_STYLE_SELECTOR))) {
						throw new InvalidAttributeException('Invalid attribute. The values allowed are "id" or "class".');
					}
				}
				
				$this->attributes = $attributes;
		}
	}
	
	public function generateAttributes()
	{	
		$output = '';
		if (null != $this->attributes) {
			$output .= ' ';
			$i = 1;
			$length = count($this->attributes);
			foreach ($this->attributes as $k => $value) {
				$output .= $k.'="'.$value;
				$output .= $i != $length ? '" ' : '"';
				$i++;
			}
		}
		return $output;
	}
}


