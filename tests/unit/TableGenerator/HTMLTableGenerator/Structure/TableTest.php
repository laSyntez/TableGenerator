<?php

use TableGenerator\HTMLTableGenerator\Structure\Table;
use TableGenerator\HTMLTableGenerator\Structure\TDCell;
use TableGenerator\HTMLTableGenerator\Structure\AttributesHandler;
use TableGenerator\HTMLTableGenerator\Structure\TR;
use TableGenerator\Storage\SplStorage;
use TableGenerator\Storage\ArrayStorage;

class TableTest extends PHPUnit_Framework_TestCase
{
    private $table;

    public function setUp()
    {
        $this->table = new Table(new SplStorage);
    }

    public function testGetAttributesHandler()
    {
        $this->table->setAttributesHandler(new AttributesHandler(array()));
        $this->assertInstanceOf(AttributesHandler::class, $this->table->getAttributesHandler());
    }

    /**
     * @dataProvider rowsProvider
     */
    public function testGenerate($expected, $attributesHandlder, array $rows)
    {
        $this->table->setAttributesHandler($attributesHandlder)
                    ->addRows($rows);
        $this->assertEquals($expected, $this->table->generate());
    }

    public function rowsProvider()
    {
        $tr = new TR(new ArrayStorage);
        $tr2 = new TR(new ArrayStorage);
        $tr2->addCells(array(new TDCell('mars')));
        return array(
            array(
                '<table></table>',
                new AttributesHandler(array()),
                array()
            ),
            array(
                '<table><tr></tr></table>',
                new AttributesHandler(array()),
                array($tr)
            ),
            array(
                '<table><tr><td colspan="1" rowspan="1">mars</td></tr></table>',
                new AttributesHandler(array()),
                array($tr2)
            ),
        );
    }

    /**
     * @dataProvider countRowsProvider
     */
    public function testCountRows($expected, $rows)
    {
        $this->table->addRows($rows);
        $this->assertEquals($expected, $this->table->countRows());
    }

    public function countRowsProvider()
    {
        $storage = new SplStorage;
        return array(
            array(0, array()),
            array(2,
                array(
                    new TR($storage),
                    new TR($storage),
                )
            ),
            array(4,
                array(
                    new TR($storage),
                    new TR($storage),
                    new TR($storage),
                    new TR($storage),
                )
            ),
        );
    }

    public function tearDown()
    {
        $this->table = null;
    }
}
