<?php

namespace HTMLTableGenerator\Structure;

use HTMLTableGenerator\Exception\InvalidColspanException;
use HTMLTableGenerator\Exception\InvalidRowspanException;

abstract class Cell 
{
	protected $content;
	protected $colspan;
	protected $rowspan;
	protected $width;
	protected $height;
	
	const WIDTH_UNDEFINED = -1;
	const HEIGHT_UNDEFINED = -1;
	
	public function __construct($content, $colspan = 1, $rowspan = 1, $width = -1, $height = -1) 
	{
		$this->setContent($content);
		$this->setColspan($colspan);
		$this->setRowspan($rowspan);
		$this->setWidth($width);
		$this->setHeight($height);
	}
	
	public function setContent($content)
	{
		if (is_string($content))  {
			$this->content = $content;
		}
	}
	
	public function getContent() { return $this->content; }
	
	public function setColspan($colspan)
	{
		if (is_numeric($colspan) && $colspan > 0)  {
			$this->colspan = $colspan;
		} else {
			throw new InvalidColspanException(sprintf('the colspan value has to be greater than %d', 0));
		}
	}
	
	public function getColspan() { return $this->colspan; }
	
	public function setRowspan($rowspan)
	{
		if (is_numeric($rowspan) && $rowspan > 0)  {
			$this->rowspan = $rowspan;
		} else {
			throw new InvalidRowspanException(sprintf('the rowspan value has to be greater than %d', 0));
		}
	}
	
	public function getRowspan() { return $this->rowspan; }
	
	public function setWidth($width)
	{
		if (is_numeric($width) && $width > 0) {
			$this->width = $width;
		}
	}
	
	public function getWidth() { return $this->width; }
	
	public function setHeight($height)
	{
		if (is_numeric($height) && $height > 0) {
			$this->height = $height;
		}
	}
	
	public function getHeight() { return $this->height; }
	
	
	abstract public function generate();
}


