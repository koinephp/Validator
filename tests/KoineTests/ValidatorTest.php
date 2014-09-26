<?php

namespace KoineTests;

use PHPUnit_Framework_TestCase;
use Koine\Validator;

class DummyValidation extends Validator
{
    /**
     * {@inheritdocs}
     */
    protected function executeValidation($value)
    {
        if (!isset($value['lastName'])) {
            $this->errors->add('lastName', 'you must set last name');
        } elseif (!$value['lastName']) {
            $this->errors->add('lastName', 'last name cannot be empty');
        }
    }
}

/**
 * @author Marcelo Jacobus <marcelo.jacobus@gmail.com>
 */
class ValidatorTest extends PHPUnit_Framework_TestCase
{
    protected $object;

    public function setUp()
    {
        $this->object = new DummyValidation();
    }

    /**
     * @test
     */
    public function abstraiValidacao()
    {
        $user = array('name' => 'Jon');
        $this->assertFalse($this->object->isValid($user));

        $user['lastName'] = '';
        $this->assertFalse($this->object->isValid($user));

        $user['lastName'] = 'Doe';
        $this->assertTrue($this->object->isValid($user));
    }

    /**
     * @test
     */
    public function conseguePegarOsErros()
    {
        $errors = $this->object->getErrors();

        $this->assertInstanceOf('Koine\Validator\ErrorCollection', $errors);

        $this->assertSame($errors, $this->object->getErrors());
    }

    /**
     * @test
     */
    public function temAcessoAsOpcoes()
    {
        $options = array('foo' => 'bar');

        $object = new DummyValidation($options);

        $this->assertEquals($options, $object->getOptions()->toArray());
        $this->assertEquals('bar', $object->getOption('foo'));
    }
}
