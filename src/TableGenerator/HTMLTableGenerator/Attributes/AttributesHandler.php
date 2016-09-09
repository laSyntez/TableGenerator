<?php

/*
 * This file is part of the TableGenerator package.
 *
 * (c) laSyntez <lasyntez@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TableGenerator\HTMLTableGenerator\Attributes;

use TableGenerator\HTMLTableGenerator\Exception\InvalidAttributeException;

/**
 * AttributesHandler handles HTML attributes of HTML tags.
 *
 * @author laSyntez <lasyntez@gmail.com>
 */
class AttributesHandler
{
	/**
	 * @var array
	 */
	protected $attributes;

	const ID_ATTRIBUTE = 'id';
	const CLASS_ATTRIBUTE = 'class';
	const STYLE_ATTRIBUTE = 'style';

	/**
	 * Constructor.
	 *
	 * @param   array   $attributes
	 */
	public function __construct($attributes)
	{
		$this->setAttributes($attributes);
	}

	/**
	 * Set the html attributes of an element
	 *
	 * @param array $attributes
	 *
	 * @throws \TableGenerator\HTMLTableGenerator\Exception\InvalidAttributeException  If the attribute name is invalid
	 */
	public function setAttributes(array $attributes)
	{
		if (null != $attributes) {
			foreach ($attributes as $k => $value) {
				if (!in_array($k, array(self::ID_ATTRIBUTE, self::CLASS_ATTRIBUTE, self::STYLE_ATTRIBUTE))) {
					throw new InvalidAttributeException('Invalid attribute name. The values allowed are "id", "class" or "style".');
				}
			}

			$this->attributes = $attributes;
		}
	}

	/**
	 * Get the html attributes of an element
	 *
	 * @return array
	 */
	public function getAttributes()
	{
		return $this->attributes;
	}

	/**
	 * Generate the html attributes of an element
	 *
	 * @return string
	 */
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
