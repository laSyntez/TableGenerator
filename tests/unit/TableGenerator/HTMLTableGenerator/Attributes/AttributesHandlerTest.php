<?php

use TableGenerator\HTMLTableGenerator\Structure\AttributesHandler;

class AttributesHandlerTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->handler = new AttributesHandler(array());
    }

    public function testgetAttributesReturnsNullIfArrayGivenToSetAttributeIsEmpty()
    {
        $this->assertNull($this->handler->getAttributes());
    }

    /**
     * @expectedException TableGenerator\HTMLTableGenerator\Exception\InvalidAttributeException
     */
    public function testSetAttributesThrowsInvalidAttributeExceptionIfUnexpectedArrayKeyExists()
    {
        $this->handler->setAttributes(array('id' => 'neptune', 'test' => 'mars'));
    }

    /**
     * @dataProvider attributesProvider
     */
    public function testGenerate($expected, $attributes)
    {
        $this->handler->setAttributes($attributes);
        $this->assertEquals($expected, $this->handler->generate());
    }

    public function attributesProvider()
    {
        return array(
            array('', array()),
            array(' class="mars"', array('class' => 'mars')),
            array(' id="neptune" class="mars"', array('id' => 'neptune', 'class' => 'mars')),
            array(' id="neptune" style="font-size: 14px; color: #000;"', array('id' => 'neptune', 'style' => 'font-size: 14px; color: #000;')),
            array(' style="padding: 0; text-align: center;" class="jupiter"', array('style' => 'padding: 0; text-align: center;', 'class' => 'jupiter')),
            array(' id="saturn" style="padding: 0; text-align: center;" class="jupiter"', array('id' => 'saturn', 'style' => 'padding: 0; text-align: center;', 'class' => 'jupiter')),
        );
    }

    public function tearDown()
    {
        $this->handler = null;
    }
}
