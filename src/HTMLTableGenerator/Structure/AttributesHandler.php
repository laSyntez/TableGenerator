<?php

namespace HTMLTableGenerator\Structure;

use HTMLTableGenerator\Exception\InvalidAttributeException;

class AttributesHandler
{	
	protected $attributes;

	const ID_ATTRIBUTE = 'id';
	const CLASS_ATTRIBUTE = 'class';
	const STYLE_ATTRIBUTE = 'style';
		
	public function __construct($attributes) 
	{
		$this->setAttributes($attributes);
	}
	
	public function setAttributes(array $attributes) 
	{
		if (null != $attributes) {
			foreach ($attributes as $k => $value) {
				if (!in_array($k, array(self::ID_ATTRIBUTE, self::CLASS_ATTRIBUTE, self::STYLE_ATTRIBUTE))) {
					throw new InvalidAttributeException('Invalid attribute. The values allowed are "id", "class" or "style".');
				}
			}
			
			$this->attributes = $attributes;
		}
	}
	
	public function getAttributes()
	{
		return $this->attributes;
	}
	
	public function generate()
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


