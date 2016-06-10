<?php

namespace TableGenerator\HTMLTableGenerator\Structure;

use TableGenerator\HTMLTableGenerator\Exception\InvalidColspanException;
use TableGenerator\HTMLTableGenerator\Exception\InvalidRowspanException;
use TableGenerator\HTMLTableGenerator\Exception\InvalidSizeException;
use TableGenerator\HTMLTableGenerator\Attributes\AttributesHandler;
use TableGenerator\GeneratorInterface;

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

	/**
	 * @param string $content
	 * @param int | string $colspan
	 * @param int | string $rowspan
	 * @param int | string $width
	 * @param int | string $height
	 * @param \TableGenerator\HTMLTableGenerator\Attributes\AttributesHandler $handler
	 */
	public function __construct($content, $colspan = 1, $rowspan = 1, $width = 0, $height = 0, AttributesHandler $handler = null)
	{
		$this->setContent($content);
		$this->setColspan($colspan);
		$this->setRowspan($rowspan);
		$this->setWidth($width);
		$this->setHeight($height);
		$this->attributesHandlder = $handler;
	}

	/**
	 * Set the content of the cell
	 *
	 * @param string $content
	 *
	 * @return Cell
	 */
	public function setContent($content)
	{
		if (is_string($content)) {
			$this->content = $content;
		}

		return $this;
	}

	/**
	 * Get the content of the cell
	 *
	 * @return string
	 */
	public function getContent()
	{
		return $this->content;
	}

	/**
	 * Set the colspan value of the cell
	 *
	 * @param int | string $colspan
	 *
	 * @return Cell
	 */
	public function setColspan($colspan)
	{
		if (!is_numeric($colspan) || $colspan < 1) {
			throw new InvalidColspanException(sprintf('the colspan value has to be greater than %d', 0));
		}

		$this->colspan = $colspan;

		return $this;
	}

	/**
	 * Get the colspan value of the cell
	 *
	 * @return int | string
	 */
	public function getColspan()
	{
		return $this->colspan;
	}

	/**
	 * Set the rowspan value of the cell
	 *
	 * @param int | string $rowspan
	 *
	 * @return Cell
	 */
	public function setRowspan($rowspan)
	{
		if (!is_numeric($rowspan) || $rowspan < 1) {
			throw new InvalidRowspanException(sprintf('the rowspan value has to be greater than %d', 0));
		}

		$this->rowspan = $rowspan;

		return $this;
	}

	/**
	 * Get the rowspan of the cell
	 *
	 * @return int | string
	 */
	public function getRowspan()
	{
		return $this->rowspan;
	}

	/**
	 * Set the width of the cell
	 *
	 * @param int | string $width
	 *
	 * @return Cell
	 */
	public function setWidth($width)
	{
		if (!is_numeric($width) || $width < 0) {
			throw new InvalidSizeException(sprintf('the width has to be equal or greater than %d', 0));
		}

		$this->width = $width;

		return $this;
	}

	/**
	 * Get the width of the cell
	 *
	 * @return int | string
	 */
	public function getWidth()
	{
		return $this->width;
	}

	/**
	 * Set the height of the cell
	 *
	 * @param int | string $height
	 *
	 * @return Cell
	 */
	public function setHeight($height)
	{
		if (!is_numeric($height) || $height < 0) {
			throw new InvalidSizeException(sprintf('the height has to be equal or greater than %d', 0));
		}

		$this->height = $height;

		return $this;
	}

	/**
	 * Get the height of the cell
	 *
	 * @return int | string
	 */
	public function getHeight()
	{
		return $this->height;
	}

	/**
	 * Set the attributes of the cell
	 *
	 * @param array $attributes
	 *
	 * @return Cell
	 */
	public function setAttributes(array $attributes)
	{
		$this->attributesHandlder->setAttributes($attributes);

		return $this;
	}

	/**
	 * Get the attributes of the cell
	 *
	 * @return array
	 */
	public function getAttributes()
	{
		return $this->attributes->getAttributes();
	}

	/**
	 * Set the attributes handler of the cell
	 *
	 * @param \TableGenerator\HTMLTableGenerator\Attributes\AttributesHandler $handler
	 *
	 * @return Cell
	 */
	public function setAttributesHandler(AttributesHandler $handler)
	{
		$this->attributesHandlder = $handler;

		return $this;
	}

	/**
	 * Get the attributes handler of the cell
	 *
	 * @return \TableGenerator\HTMLTableGenerator\Attributes\AttributesHandler
	 */
	public function getAttributesHandler()
	{
		return $this->attributesHandlder;
	}

	/**
	 * Get the html code of the cell
	 *
	 * @return string
	 */
	abstract public function generate();
}
