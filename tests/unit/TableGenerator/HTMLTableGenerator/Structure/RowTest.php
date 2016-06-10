<?php

use TableGenerator\HTMLTableGenerator\Structure\Row;
use TableGenerator\HTMLTableGenerator\Structure\THCell;
use TableGenerator\HTMLTableGenerator\Structure\TDCell;
use TableGenerator\HTMLTableGenerator\Structure\Attributes;
use TableGenerator\HTMLTableGenerator\Attributes\AttributesHandler;
use TableGenerator\Storage\ArrayStorage;

class RowTest extends PHPUnit_Framework_TestCase
{
    private $tr;

    public function setUp()
    {
        $this->tr = new Row(new ArrayStorage);
    }

    public function testGetAttributesHandler()
    {
        $this->tr->setAttributesHandler(new AttributesHandler(array()));
        $this->assertInstanceOf(AttributesHandler::class, $this->tr->getAttributesHandler());
    }

    /**
     * @dataProvider dataProvider
     */
    public function testGenerate($expected, $attributesHandlder, $cells)
    {
        $this->tr->setAttributesHandler($attributesHandlder)
                 ->addCells($cells);

         $this->assertEquals($expected, $this->tr->generate());
    }

    public function dataProvider()
    {
        return array(
            array(
                '<tr></tr>',
                new AttributesHandler(array()),
                array()
            ),
            array(
                '<tr><td colspan="1" rowspan="1"></td></tr>',
                new AttributesHandler(array()),
                array(new TDCell('', 1, 1, 0, 0, new AttributesHandler(array())))
            ),
            array(
                '<tr><td colspan="1" rowspan="1"></td><td colspan="2" rowspan="1"><div style="width: 180px;height: 90px;">Jupiter</div></td></tr>',
                new AttributesHandler(array()),
                array(
                    new TDCell('', 1, 1, 0, 0, new AttributesHandler(array())),
                    new TDCell('Jupiter', 2, 1, 180, 90, new AttributesHandler(array()))
                )
            ),
            array(
                '<tr><th colspan="2" rowspan="4"><div style="width: 80px;height: 20px;">Saturn</div></th><th colspan="1" rowspan="1"></th></tr>',
                new AttributesHandler(array()),
                array(
                    new THCell('Saturn', 2, 4, 80, 20, new AttributesHandler(array())),
                    new THCell('', 1, 1, 0, 0, new AttributesHandler(array()))
                )
            ),
        );
    }

    /**
     * @dataProvider cellsProvider
     */
    public function testCountCells($expected, $cells)
    {
        $this->tr->addCells($cells);
        $this->assertEquals($expected, $this->tr->countCells());
    }

    public function cellsProvider()
    {
        return array(
            array(0, array()),
            array(2,
                array(
                    new TDCell('', 1, 4, 0, 0, new AttributesHandler(array())),
                    new TDCell('', 1, 1, 150, 0, new AttributesHandler(array())),
                )
            ),
            array(5,
                array(
                    new TDCell('', 3, 1, 0, 0, new AttributesHandler(array())),
                    new TDCell(''),
                    new TDCell('', 1, 2, 0, 0, new AttributesHandler(array())),
                    new TDCell('', 1, 1, 20, 0, new AttributesHandler(array())),
                    new TDCell('', 1, 1, 0, 80, new AttributesHandler(array())),
                )
            ),
        );
    }

    public function tearDown()
    {
        $this->tr = null;
    }
}
