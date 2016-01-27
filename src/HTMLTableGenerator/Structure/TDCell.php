<?php

namespace HTMLTableGenerator\Structure;

class TDCell extends Cell
{	
	public function generate()
	{
		$styleContent = '';
		//var_dump($this->width);die;
		if ($this->width != self::WIDTH_UNDEFINED) {
			$styleContent .= 'width: '.$this->width.'px;';
		}
		if ($this->height != self::HEIGHT_UNDEFINED) {
			$styleContent .= 'height: '.$this->height.'px;';
		}
		
		$output = '<td';
		if (null != $this->attributesHandlder) {
			$output .= $this->attributesHandlder->generate();		
		}
		
		$output .= ('' == $styleContent)
			? ' colspan="'.$this->colspan.'" rowspan="'.$this->rowspan.'">' .$this->content. '</td>'
			: ' colspan="'.$this->colspan.'" rowspan="'.$this->rowspan.'"><div style="'.$styleContent.'">' .$this->content. '</div></td>'
		;
		
		return $output;
	}
}


