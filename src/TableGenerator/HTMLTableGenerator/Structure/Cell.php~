<?php

namespace TableGenerator\HTMLTableGenerator\Structure;

use TableGenerator\HTMLTableGenerator\Exception\InvalidColspanException;
use TableGenerator\HTMLTableGenerator\Exception\InvalidRowspanException;
use TableGenerator\HTMLTableGenerator\Exception\InvalidSizeException;

abstract class Cell 
{
	protected $content;
	protected $colspan;
	protected $rowspan;
	protected $width;
	protected $height;
	protected $attributesHandlder;
	
	const WIDTH_UNDEFINED = 0;
	const HEIGHT_UNDEFINED = 0;
	
	public function __construct($content, $colspan = 1, $rowspan = 1, $width = 0, $height = 0, AttributesHandler $handler = null) 
	{
		$this->setContent($content);
		$this->setColspan($colspan);
		$this->setRowspan($rowspan);
		$this->setWidth($width);
		$this->setHeight($height);
		$this->attributesHandlder = $handler;
	}
	
	public function setContent($content)
	{
		if (is_string($content)) {
			$this->content = $content;
		}
		
		return $this;
	}
	
	public function getContent() { return $this->content; }
	
	public function setColspan($colspan)
	{
		if (!is_numeric($colspan) || $colspan < 1) {
			throw new InvalidColspanException(sprintf('the colspan value has to be greater than %d', 0));
		} 
		
		$this->colspan = $colspan;
		
		return $this;
	}
	
	public function getColspan() { return $this->colspan; }
	
	public function setRowspan($rowspan)
	{
		if (!is_numeric($rowspan) || $rowspan < 1) {
			throw new InvalidRowspanException(sprintf('the rowspan value has to be greater than %d', 0));
		} 
				
		$this->rowspan = $rowspan;
		
		return $this;
	}
	
	public function getRowspan() { return $this->rowspan; }
	
	public function setWidth($width)
	{
		if (!is_numeric($width) || $width < 0) {
			throw new InvalidSizeException(sprintf('the width has to be equal or greater than %d', 0));
		} 
		
		$this->width = $width;
		
		return $this;
	}
	
	public function getWidth() { return $this->width; }
	
	public function setHeight($height)
	{
		if (!is_numeric($height) || $height < 0) {
			throw new InvalidSizeException(sprintf('the height has to be equal or greater than %d', 0));
		} 
		
		$this->height = $height;
		
		return $this;
	}
	
	public function getHeight() { return $this->height; }
	
	public function setAttributes(array $attributes) 
	{
		$this->attributesHandlder->setAttributes($attributes);
	}
	
	public function getAttributes()
	{
		return $this->attributes->getAttributes();
	}
	
	public function setAttributesHandler(AttributesHandler $handler) 
	{
		$this->attributesHandlder = $handler;
	}
	
	public function getAttributesHandler()
	{
		return $this->attributesHandlder;
	}
	
	abstract public function generate();
}


