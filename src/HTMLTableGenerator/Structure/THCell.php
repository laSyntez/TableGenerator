<?php

namespace HTMLTableGenerator\Structure;

class THCell extends Cell
{	
	public function generate()
	{
		$styleContent = '';
		if ($this->width != self::WIDTH_UNDEFINED) {
			$styleContent .= 'width: '.$this->width.'px;';
		}
		if ($this->height != self::HEIGHT_UNDEFINED) {
			$styleContent .= 'height: '.$this->height.'px;';
		}
		return '' == $styleContent
			? '<th colspan="'.$this->colspan.'" rowspan="'.$this->rowspan.'">' .$this->content. '</th>'
			: '<th colspan="'.$this->colspan.'" rowspan="'.$this->rowspan.'"><div style="'.$styleContent.'">' .$this->content. '</div></th>'
		;
	}
}


