<?php

namespace HTMLTableGenerator\Structure;

class THCell extends Cell
{	
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


