<?php

use TableGenerator\HTMLTableGenerator\Structure\THCell;
use TableGenerator\HTMLTableGenerator\Structure\AttributesHandler;

class THCellTest extends PHPUnit_Framework_TestCase
{
    private $th;

    public function setUp()
    {
        $this->th = new THCell('');
    }

    /**
     * @dataProvider dataProvider
     */
    public function testGenerate($expected, $attributes)
    {
        $this->th->setContent($attributes[0])
                 ->setColspan($attributes[1])
                 ->setRowspan($attributes[2])
                 ->setWidth($attributes[3])
                 ->setHeight($attributes[4])
                 ->setAttributesHandler($attributes[5]);

         $this->assertEquals($expected, $this->th->generate());
    }

    public function dataProvider()
    {
        return array(
            array(
                '<th colspan="1" rowspan="1"></th>',
                array('', 1, 1, 0, 0, new AttributesHandler(array()))
            ),
            array(
                '<th colspan="1" rowspan="1"><div style="width: 380px;"></div></th>',
                array('', 1, 1, 380, 0, new AttributesHandler(array()))
            ),
            array(
                '<th colspan="1" rowspan="1"><div style="height: 80px;"></div></th>',
                array('', 1, 1, 0, 80, new AttributesHandler(array()))
            ),
            array(
                '<th colspan="1" rowspan="1"><div style="width: 340px;height: 80px;"></div></th>',
                array('', 1, 1, 340, 80, new AttributesHandler(array()))
            ),
        );
    }

    public function tearDown()
    {
        $this->th = null;
    }
}
