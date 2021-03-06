<?php

/*
 * This file is part of the TableGenerator package.
 *
 * (c) laSyntez
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TableGenerator\HTMLTableGenerator\Structure;

class THCell extends Cell
{
	/**
     * {@inheritdoc}
     */
	public function generate()
	{
		$output = '<th';
		if (null != $this->attributesHandlder) {
			$output .= $this->attributesHandlder->generate();
		}

		$styleContent = '';
		if ($this->width != self::WIDTH_UNDEFINED) {
			$styleContent .= 'width: '.$this->width.'px;';
		}

		if ($this->height != self::HEIGHT_UNDEFINED) {
			$styleContent .= 'height: '.$this->height.'px;';
		}

		$output .= ' colspan="'.$this->colspan.'" rowspan="'.$this->rowspan.'">';
		$output .= '' == $styleContent
			? $this->content. '</th>'
			: '<div style="'.$styleContent.'">' .$this->content. '</div></th>'
		;

		return $output;
	}
}
