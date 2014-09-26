<?php

namespace KoineTests\Validator;

use Koine\Validator\ErrorCollection;
use PHPUnit_Framework_TestCase;

/**
 * @author Marcelo Jacobus <marcelo.jacobus@gmail.com>
 */
class ErrorCollectionTest extends PHPUnit_Framework_TestCase
{
    protected $object;

    public function setUp()
    {
        $this->object = new ErrorCollection();
    }

    /**
     * @test
     */
    public function verificaSeEstaVazio()
    {
        $this->assertTrue($this->object->isEmpty());

        $empty = $this->object->add('field', 'Invalid')->isEmpty();

        $this->assertFalse($empty);
    }

    /**
     * @test
     */
    public function consegueAdicionarEBuscarErrosPelaChaveEGeral()
    {
        $expected = array();

        $actual = $this->object['field'];

        $this->assertNull($actual);

        // add error

        $this->object->add('field', 'error 1')
            ->add('field', 'error 2');

        $expected = array(
            'error 1',
            'error 2',
        );

        $actual = $this->object['field']->toArray();

        $this->assertEquals($expected, $actual);

        // add to different field
        $this->object->add('foo', 'error 1');

        $expected = array('error 1');

        $actual = $this->object['foo'];

        $this->assertEquals($expected, $actual->toArray());

        // get all
        $expected = array(
            'field' => array('error 1', 'error 2'),
            'foo' => array('error 1'),
        );

        $actual = $this->object->toArray();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function clearEsvaziaErrors()
    {
        $actual = $this->object->add('foo', 'error')->clear()->toArray();

        $expected = array();

        $this->assertEquals($expected, $actual);
    }
}
