<?php

use TableGenerator\HTMLTableGenerator\Structure\TDCell;
use TableGenerator\HTMLTableGenerator\Structure\AttributesHandler;

class TDCellTest extends PHPUnit_Framework_TestCase
{
    private $td;

    public function setUp()
    {
        $this->td = new TDCell('');
    }

    /**
     * @dataProvider invalidContentProvider
     */
    public function testGetContentReturnsEmptyStringIfContentSetterInvokedWithNonStringParameter($value)
    {
        $this->td->setContent($value);
        $this->assertEmpty($this->td->getContent());
    }

    public function invalidContentProvider()
    {
        return array(
            array(55454),
            array(array()),
            array(new stdClass)
        );
    }

    /**
     * @dataProvider contentProvider
     */
    public function testGetContent($expected, $value)
    {
        $this->td->setContent($value);
        $this->assertEquals($expected, $this->td->getContent());
    }

    public function contentProvider()
    {
        return array(
            array('pluton', 'pluton'),
            array('<div>Cell content</div>', '<div>Cell content</div>')
        );
    }

    public function testGetAttributesHandler()
    {
        $this->td->setAttributesHandler(new AttributesHandler(array()));
        $this->assertInstanceOf(AttributesHandler::class, $this->td->getAttributesHandler());
    }

    /**
     * @dataProvider dataProvider
     */
    public function testGenerate($expected, $attributes)
    {
        $this->td->setContent($attributes[0])
                 ->setColspan($attributes[1])
                 ->setRowspan($attributes[2])
                 ->setWidth($attributes[3])
                 ->setHeight($attributes[4])
                 ->setAttributesHandler($attributes[5]);

         $this->assertEquals($expected, $this->td->generate());
    }

    public function dataProvider()
    {
        return array(
            array(
                '<td colspan="1" rowspan="1"></td>',
                array('', 1, 1, 0, 0, new AttributesHandler(array()))
            ),
            array(
                '<td colspan="1" rowspan="1"><div style="width: 380px;"></div></td>',
                array('', 1, 1, 380, 0, new AttributesHandler(array()))
            ),
            array(
                '<td colspan="1" rowspan="1"><div style="height: 80px;"></div></td>',
                array('', 1, 1, 0, 80, new AttributesHandler(array()))
            ),
            array(
                '<td colspan="1" rowspan="1"><div style="width: 340px;height: 80px;"></div></td>',
                array('', 1, 1, 340, 80, new AttributesHandler(array()))
            ),
        );
    }

    /**
     * @expectedException TableGenerator\HTMLTableGenerator\Exception\InvalidColspanException
     * @dataProvider valuesProvider
     */
    public function testsetColspanThrowsExceptionIfValueIsNotANumberOrLesserThanOne($value)
    {
        $this->td->setColspan($value);
    }

    /**
     * @expectedException TableGenerator\HTMLTableGenerator\Exception\InvalidRowspanException
     * @dataProvider valuesProvider
     */
    public function testsetRowspanThrowsExceptionIfValueIsNotANumberOrLesserThanOne($value)
    {
        $this->td->setRowspan($value);
    }

    /**
     * @expectedException TableGenerator\HTMLTableGenerator\Exception\InvalidSizeException
     * @dataProvider sizesProvider
     */
    public function testsetWidthThrowsExceptionIfValueIsNotANumberOrLesserThanOne($value)
    {
        $this->td->setWidth($value);
    }

    /**
     * @expectedException TableGenerator\HTMLTableGenerator\Exception\InvalidSizeException
     * @dataProvider sizesProvider
     */
    public function testsetHeightThrowsExceptionIfValueIsNotANumberOrLesserThanOne($value)
    {
        $this->td->setHeight($value);
    }

    public function valuesProvider()
    {
        return array(
            array('one'),
            array(0)
        );
    }

    public function sizesProvider()
    {
        return array(
            array('one'),
            array(-1)
        );
    }

    public function tearDown()
    {
        $this->td = null;
    }
}
