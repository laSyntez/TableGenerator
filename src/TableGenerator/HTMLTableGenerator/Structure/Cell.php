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

use TableGenerator\HTMLTableGenerator\Exception\InvalidColspanException;
use TableGenerator\HTMLTableGenerator\Exception\InvalidRowspanException;
use TableGenerator\HTMLTableGenerator\Exception\InvalidSizeException;
use TableGenerator\HTMLTableGenerator\Attributes\AttributesHandler;
use TableGenerator\GeneratorInterface;

/**
 * Cell represents an HTML Table cell (an HTML tag).
 *
 * @author laSyntez <lasyntez@gmail.com>
 */
abstract class Cell
{
	/**
	 * @var string
	 */
	protected $content;

	/**
	 * @var int|string
	 */
	protected $colspan;

	/**
	 * @var int|string
	 */
	protected $rowspan;

	/**
	 * @var int|string
	 */
	protected $width;

	/**
	 * @var int|string
	 */
	protected $height;

	/**
	 * The html attributes handler
	 *
	 * @var \TableGenerator\HTMLTableGenerator\Attributes\AttributesHandler
	 */
	protected $attributesHandlder;

	const WIDTH_UNDEFINED = 0;
	const HEIGHT_UNDEFINED = 0;

	/**
	 * Constructor.
	 *
	 * @param   string   $content   The content
	 * @param   int|string   $colspan   The colspan
	 * @param   int|string   $rowspan   The rowspan
	 * @param   int|string   $width   The width
	 * @param   int|string   $height   The height
	 * @param   \TableGenerator\HTMLTableGenerator\Attributes\AttributesHandler   $handler   The html attributes handler
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
	 * Sets the content of the cell
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
	 * Gets the content of the cell
	 *
	 * @return string
	 */
	public function getContent()
	{
		return $this->content;
	}

	/**
	 * Sets the colspan value of the cell
	 *
	 * @param int|string $colspan
	 *
	 * @return Cell
	 *
	 * @throws \TableGenerator\HTMLTableGenerator\Exception\InvalidColspanException If the colspan value is not a number or lesser than 1
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
	 * Gets the colspan value of the cell
	 *
	 * @return int|string
	 */
	public function getColspan()
	{
		return $this->colspan;
	}

	/**
	 * Sets the rowspan value of the cell
	 *
	 * @param int|string $rowspan
	 *
	 * @return Cell
	 *
	 * @throws \TableGenerator\HTMLTableGenerator\Exception\InvalidRowspanException If the rowspan value is not a number or lesser than 1
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
	 * Gets the rowspan of the cell
	 *
	 * @return int|string
	 */
	public function getRowspan()
	{
		return $this->rowspan;
	}

	/**
	 * Sets the width of the cell
	 *
	 * @param int|string $width
	 *
	 * @return Cell
	 *
	 * @throws \TableGenerator\HTMLTableGenerator\Exception\InvalidSizeException If the width is not a number or lesser than 0
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
	 * Gets the width of the cell
	 *
	 * @return int|string
	 */
	public function getWidth()
	{
		return $this->width;
	}

	/**
	 * Sets the height of the cell
	 *
	 * @param int|string $height
	 *
	 * @return Cell
	 *
	 * @throws \TableGenerator\HTMLTableGenerator\Exception\InvalidSizeException If the height is not a number or lesser than 0
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
	 * Gets the height of the cell
	 *
	 * @return int|string
	 */
	public function getHeight()
	{
		return $this->height;
	}

	/**
	 * Sets the attributes of the cell
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
	 * Gets the attributes of the cell
	 *
	 * @return array
	 */
	public function getAttributes()
	{
		return $this->attributes->getAttributes();
	}

	/**
	 * Sets the attributes handler of the cell
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
	 * Gets the attributes handler of the cell
	 *
	 * @return \TableGenerator\HTMLTableGenerator\Attributes\AttributesHandler
	 */
	public function getAttributesHandler()
	{
		return $this->attributesHandlder;
	}

	/**
	 * Generates the html code of the cell
	 *
	 * @return string
	 */
	abstract public function generate();
}
