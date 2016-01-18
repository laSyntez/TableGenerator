<?php

namespace HTMLTableGenerator\Structure;

class TDCell extends Cell
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
			? '<td colspan="'.$this->colspan.'" rowspan="'.$this->rowspan.'">' .$this->content. '</td>'
			: '<td colspan="'.$this->colspan.'" rowspan="'.$this->rowspan.'"><div style="'.$styleContent.'">' .$this->content. '</div></td>'
		;
	}
}


